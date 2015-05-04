@extends('app')

{{-- CSS --}}
@section('styles') 
	<link rel="stylesheet" href="{{asset('/css/datepicker.css')}}">
@stop

@section('title') Recode Admin @stop
@section('content')
	@if ($error = Session::get('error'))
		<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Fail</h4>
			{{ $error }}
		</div>
	@endif
	@if ($success = Session::get('success'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Success</h4>
			{{ $success }}
		</div>
	@endif
	<div class="row">
		<div class="page-header">
			<h2>Recodes</h2>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<a href="{{URL::to('/admin/recodes/create')}}">Add a Recode</a>
		</div>
	</div>
	<hr>
	<!-- use to select date -->
	<div class="row">
		<div class="form-group">
			<label class="col-md-4 control-label">{{{ trans('recode.date') }}}</label>
			<div class="col-md-6">
				<input type="text" class="form-control datepicker" name="change_date" id="change_date">
			</div>
		</div>
	</div>
	@if(count($recodes) >0)
		<div class="row">
			<table class="table">
				<thead>
					<tr>
						<th>user name</th>
						<th>pet name</th>
						<th>service</th>
						<th>price</th>
						<th>payment method</th>
						<th>service date</th>
						<th>create date</th>
						<th>update date</th>
						<th>status</th>
						<th>paied</th>
						<th>action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($recodes as $recode)
						<tr>
							<td>{!!$recode->user->name!!}</td>
							<td>{!!$recode->pet->name!!}</td>
							<td>{!!$services[$recode->service]!!}</td>
							<td>{!!$recode->price!!}</td>
							<td>{!!$payment_method[$recode->payment]!!}</td>
							<td>{!!$recode->service_date!!}</td>
							<td>{!!$recode->created_at!!}</td>
							<td>{!!$recode->updated_at!!}</td>
							<td>{!!$status[$recode->status]!!}</td>
							<td>@if($recode->paied==1) settle @else give me money @endif</td>
							<td>
								@if (!in_array($recode->status,array(4,5,6)))
									<a class="text-info" href="{{URL::to('admin/recodes/edit/'.$recode->id)}}">Edit</a>
									<!-- <a class="text-warning" href="{{URL::to('admin/recode/cancel/'.$recode->id)}}">Cancel</a> -->
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@else
		<div class="row">
			<p>No Recodes For {!!$date!!}</p>
		</div>
	@endif
@endsection

{{-- Scripts --}}
@section('scripts')
	@parent
	<script src="{{asset('js/date-time/bootstrap-datepicker.min.js')}}"></script>

	<script>
		$('#myCarousel').carousel({
			interval: 4000
		});

		$(function(){
			$('#change_date').val("{!!$date!!}");
			$('.datepicker').datepicker({
				 format: 'yyyy-mm-dd',
			});
			$('#change_date').change(function(){
				window.location= "{!! URL::to('/admin/recodes/') !!}"+"/"+$('#change_date').val();
			});
		});
	</script>
@endsection
@stop