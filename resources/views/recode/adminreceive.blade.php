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

			<form class="form-horizontal" role="form" method="POST" action="{!! URL::to('/admin/recodes/receive') !!}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
					
				@foreach ($recodes as $date=>$date_recodes)
					<label>{{$date}}--已經預約數量:{{$date_count[$date]}}</label>
					<table class="table">	
						<thead>
							<tr>
								<th>{{{ trans('recode.user') }}}</th>
								<th>{{{ trans('recode.pet') }}}</th>
								<th>{{{ trans('recode.create_at') }}}</th>
								<th></th>
							</tr>	
						</thead>
						<tbody>
							@foreach($date_recodes as $recode)
								<tr>
									<td>{{{$recode->user->name}}}</td>
									<td>{{{$recode->pet->name}}}</td>
									<td>{{{$recode->created_at}}}</td>
									<td><input type="checkbox" class="checkbox" value="{{$recode->id}}" name="checked_recode[]"></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					
				@endforeach 

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

				<!-- <div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.price') }}}</label>
					<div class="col-md-6">
						<input  type="text" class="form-control " name="price" value="" >
					</div>
				</div> -->
				
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