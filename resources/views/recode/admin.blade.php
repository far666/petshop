@extends('app')
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

	<!-- use to select date -->
	<div class="row">

	</div>
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
					<th>action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($recodes as $recode)
					<tr>
						<td>{!!$recode->user->name!!}</td>
						<td>{{$services[$recode->service]}}</td>
						<td>{!!$recode->price!!}</td>
						<td>{{$payment_method[$recode->payment]}}</td>
						<td>{!!$recode->service_date!!}</td>
						<td>{!!$recode->created_at!!}</td>
						<td>{!!$recode->updated_at!!}</td>
						<td>{!!$status[$recode->status]!!}</td>
						<td>
							<a class="text-info" href="{{URL::to('admin/recode/edit/'.$recode->id)}}">Edit</a>
							<!-- <a class="text-warning" href="{{URL::to('admin/recode/cancel/'.$recode->id)}}">Cancel</a> -->
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection

@section('scripts')
	@parent
	<script>
		$('#myCarousel').carousel({
			interval: 4000
		});

	</script>
@endsection
@stop
