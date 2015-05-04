@extends('app')
@section('title') Home :: @parent @stop
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
			<h2>Recode</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<a href="{{URL::to('recode/create')}}">reserve</a>
		</div>
	</div>
	
	<div class="row">
		<h2>My Recodes</h2>
		@foreach ($user->pets as $pet)
			<h3><a href="{{URL::to('pet/show/'.$pet->id.'')}}">{!!$pet->name!!}</a></h3>
			<table class="table">
				<thead>
					<tr>
						<th>user name</th>
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
					@foreach ($pet->recodes->take(3) as $recode)
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
								@if($recode->status == array_search('預約中',$status) || $recode->status == array_search('預約成功',$status))
									@if($recode->user_id == $user->id)
										<a class="text-info" href="{{URL::to('recode/edit/'.$recode->id)}}">Edit</a>
										<a class="text-warning" href="{{URL::to('recode/cancel/'.$recode->id)}}">Cancel</a>
									@endif
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endforeach	
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
