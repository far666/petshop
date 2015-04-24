@extends('app')
@section('title') Home :: @parent @stop
@section('content')
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
	@if(count($recodes)>0)
		<div class="row">
			<h2>My Recodes</h2>


			<table class="table">
				<thead>
					<tr>
						<!-- <th>recode id</th> -->
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
							<!-- <td>{!!$recode->id!!}</td> -->
							<td>{!!$recode->pet->name!!}</td>
							<td>{!!$recode->service!!}</td>
							<td>{!!$recode->price!!}</td>
							<td>{!!$recode->payment!!}</td>
							<td>{!!$recode->service_date!!}</td>
							<td>{!!$recode->created_at!!}</td>
							<td>{!!$recode->updated_at!!}</td>
							<td>{!!$status[$recode->status]!!}</td>
							<td></td>
						</tr>	
					@endforeach
				</tbody>
			</table>
		</div>
	@endif	
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
