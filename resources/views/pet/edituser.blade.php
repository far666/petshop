@extends('app')
@section('title') Edit Pet User @stop
@section('content')
	<div class="row">
		<div class="page-header">
			<h2>Edit Pet User</h2>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			

		@include('errors.list')

		<form class="form-horizontal" role="form" method="POST" action="{!! URL::to('/pet/edituser/'.$pet->id) !!}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form-group">
				<label class="col-md-4 control-label">{{{ trans('pet.pet_users') }}}</label>

				<div class="col-md-6">
					<select name="user_id[]"  class="form-control input-sm" multiple>
						@foreach ($users as $user)
							<option value="{!! $user->id !!}" @if (in_array($user->id,$selected)) selected @endif>{!! $user->name !!}</option>
						@endforeach
					</select>
				</div>
			</div>	

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-primary">
						Edit Pet User
					</button>
				</div>
			</div>
		</form>
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
