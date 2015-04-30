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
			<h2>{{{ trans('recode.edit_title') }}}</h2>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			@include('errors.list')

			<form class="form-horizontal" role="form" method="POST" action="{!! URL::to('/admin/recodes/edit/'.$recode->id) !!}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.pet') }}}</label>

					<div class="col-md-6">
						{{$recode->pet->name}}
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.service') }}}</label>

					<div class="col-md-6">
						<select name="service" class="form-control input-sm">
							@foreach ($services as $key =>$service)
								<option value="{{{$key}}}" @if($key == $recode->service) selected @endif>{{{$service}}}</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('pet.service_date') }}}</label>

					<div class="col-md-6">
						<input type="text" class="form-control datepicker" name="service_date" value="{{{date("m/d/Y",strtotime($recode->service_date))}}}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.payment_method') }}}</label>

					<div class="col-md-6">
						<select name="payment" class="form-control input-sm">
							@foreach ($payment_method as $key=>$method)
								<option value="{{{$key}}}" @if($key == $recode->payment) selected @endif>{{{$method}}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.status') }}}</label>

					<div class="col-md-6">
						<select name="status" class="form-control input-sm">
							@foreach ($status as $key=>$status_name)
								<option value="{{{$key}}}" @if($key == $recode->status) selected @endif>{{{$status_name}}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.price') }}}</label>

					<div class="col-md-6">
						<input  type="text" class="form-control " name="price" value="{{$recode->price}}" >
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.paied') }}}</label>

					<div class="col-md-6">
						<input  type="checkbox" class="form-inline checkbox " name="paied" value="1" @if($recode->paied == 1) checked @endif >
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
		/*function cancel(){
			var check = confirm("Are You Sure To Cancel ?");
			if(check){
				window.location= "{!! URL::to('/recode/cancel/'.$recode->id) !!}";
			}
		}*/
	</script>
@stop