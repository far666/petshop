@extends('app')

{{-- Web site Title --}}
@section('title') {{{ trans('recode.create') }}} :: @parent @stop

{{-- CSS --}}
@section('styles') 
	<link rel="stylesheet" href="{{asset('/css/datepicker.css')}}">
@stop

{{-- Content --}}
@section('content')
	<div class="row">
		<div class="page-header">
			<h2>{{{ trans('recode.create') }}}</h2>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			@include('errors.list')

			<form class="form-horizontal" role="form" method="POST" action="{!! URL::to('/admin/recodes/create') !!}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.service_date') }}}</label>

					<div class="col-md-6">
						<input type="text" class="form-control datepicker" name="service_date" value="{{ date('m/d/Y') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.search_user_by') }}}</label>
					<div class="col-md-6">
						<select class="select input-sm"  id="method" name="method">
							<option value="phone">{{{ trans('recode.phone') }}}</option>
							<option value="name">{{{ trans('recode.name') }}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.search_user_data') }}}</label>
					<div class="col-md-6">
						<input  type="text" class="form-control " name="data" id="data">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label"></label>
					<div class="col-md-6">
						<button type="button" class="btn" onClick="searchUser()">Search</button>
					</div>
					
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.user') }}}</label>
					<div class="col-md-6">
						<select name="user_id" class="form-control input-sm" id="user_id" onchange="searchPet()">
							<option value="0"></option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.pet') }}}</label>
					<div class="col-md-6">
						<select name="pet_id" class="form-control input-sm" id="pets">
							<option value="0"></option>
						</select>
					</div>
				</div>
					
				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.service') }}}</label>

					<div class="col-md-6">
						<select name="service" class="form-control input-sm">
							@foreach ($services as $key =>$service)
								<option value="{{{$key}}}">{{{$service}}}</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.payment_method') }}}</label>

					<div class="col-md-6">
						<select name="payment" class="form-control input-sm">
							@foreach ($payment_method as $key=>$method)
								<option value="{{{$key}}}">{{{$method}}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.status') }}}</label>

					<div class="col-md-6">
						<select name="status" class="form-control input-sm">
							@foreach ($status as $key=>$status_name)
								<option value="{{{$key}}}">{{$status_name}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.price') }}}</label>

					<div class="col-md-6">
						<input  type="text" class="form-control " name="price" value="" >
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.paied') }}}</label>

					<div class="col-md-6">
						<input  type="checkbox" class="form-inline checkbox " name="paied" value="1" >
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn btn-primary">
							{{{ trans('recode.edit') }}}
						</button>
						<!-- <button type="button" class="btn btn-danger" onclick="cancel()">
							{{{ trans('recode.cancel') }}}
						</button> -->
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection


{{-- Scripts --}}
@section('scripts') 
	<script src="{{asset('js/date-time/bootstrap-datepicker.min.js')}}"></script>

	<script type="text/javascript">
		$(function(){
			$('.datepicker').datepicker();
		});

		function searchUser() {
			$.ajax({
				url: "{!! URL::to('/admin/recodes/finduser') !!}",
				type: "post",
				dataType: "json",
				data:{
					'method' : $('#method').val() ,
					'data' : $('#data').val() ,
					'_token' : '{{csrf_token()}}'
				},
				async: false,
				cache: false,
				success: function(data) {
					if(data.msg){
						alert(data.msg);
						return;
					}
					
					var html = '';
					$.each(data,function(index,user){
						html += "<option value="+user.id+">"+user.name+"</option>";
					});
					
					$('#user_id').empty();
					$('#user_id').append(html);
					searchPet();
				},
				error: function() {
					console.log("Error!");
				}
			});
		}

		function searchPet() {
			$.ajax({
				url: "{!! URL::to('/admin/recodes/findpet') !!}",
				type: "post",
				dataType: "json",
				data:{
					'user_id' : $('#user_id').val() ,
					'_token' : '{{csrf_token()}}'
				},
				async: false,
				cache: false,
				success: function(data) {
					if(data.msg){
						alert(data.msg);
						return;
					}

					var html = '';
					$.each(data,function(index,pet){
						html += "<option value="+pet.id+">"+pet.name+"</option>";
					});

					$('#pets').empty();
					$('#pets').append(html);
				},
				error: function() {
					console.log("Error!");
				}
			});
		}
	</script>
@stop