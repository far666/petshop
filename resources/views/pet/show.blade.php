@extends('app')
@section('title') Show Pet @stop
@section('content')
	<div class="row">
		<div class="page-header">
			<h2>Show Pet : {!! $pet->name!!}</h2>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<!-- <div class="col-md-2">
				<label><a href="{{URL::to('pet/reserve/'.$pet->id)}}">Reserve</a></label>
			</div> -->
			@if($admin)
				<div class="col-md-2">
					<label><a href="{{URL::to('pet/edit/'.$pet->id)}}">Edit Pet</a></label>
				</div>	
				<div class="col-md-2">
					<label><a href="{{URL::to('pet/adduser/'.$pet->id)}}">Add user</a></label>
				</div>
				<div class="col-md-2">
					<label><a href="{{URL::to('pet/deluser/'.$pet->id)}}">Del user</a></label>
				</div>
			@endif
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<label class="col-md-4 control-label">{{{ trans('pet.petname') }}}</label>

				<div class="col-md-6">
					{!!$pet->name!!}
				</div>
			</div>
			<div class="row">
				<label class="col-md-4 control-label">{{{ trans('pet.kind') }}}</label>

				<div class="col-md-6">
					{!!$pet->kind->name!!}
				</div>
			</div>
			<div class="row">
				<label class="col-md-4 control-label">{{{ trans('pet.type') }}}</label>

				<div class="col-md-6">
					{!!$pet->type->name!!}
				</div>
			</div>
			<div class="row">
				<label class="col-md-4 control-label">{{{ trans('pet.sex') }}}</label>

				<div class="col-md-6">
					{!!$pet->sex!!}
				</div>
			</div>
			<div class="row">
				<label class="col-md-4 control-label">{{{ trans('pet.born') }}}</label>

				<div class="col-md-6">
					{!!$pet->born!!}
				</div>
			</div>
			<div class="row">
				<label class="col-md-4 control-label">{{{ trans('pet.tall') }}}</label>

				<div class="col-md-6">
					{!!$pet->tall!!}
				</div>
			</div>
			<div class="row">
				<label class="col-md-4 control-label">{{{ trans('pet.weight') }}}</label>

				<div class="col-md-6">
					{!!$pet->weight!!}
				</div>
			</div>
			<div class="row">
				<label class="col-md-4 control-label">{{{ trans('pet.pet_users') }}}</label>

				<div class="col-md-6">
					@foreach($pet->users as $user)
						{!!$user->name!!},
					@endforeach
				</div>
			</div>
		</div>
	</div>

	<!-- show pets recode -->
	<div class="row">
		<div class="col-md-12">
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
					@foreach ($pet->recodes as $recode)
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
		</div>		
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
