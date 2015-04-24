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
			<div class="col-md-2">
				<label><a href="{{URL::to('pet/reserve/'.$pet->id)}}">Reserve</a></label>
			</div>
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
