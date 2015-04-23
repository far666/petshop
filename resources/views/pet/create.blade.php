@extends('app')

{{-- Web site Title --}}
@section('title') {{{ trans('pet.addtitle') }}} :: @parent @stop

{{-- CSS --}}
@section('styles') 
	<link rel="stylesheet" href="{{asset('/css/datepicker.css')}}">
@stop

{{-- Content --}}
@section('content')
	<div class="row">
		<div class="page-header">
			<h2>{{{ trans('pet.add') }}}</h2>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			{{--<div class="col-md-8 col-md-offset-2">--}}
				{{--<div class="panel panel-default">--}}
					{{--<div class="panel-heading">Register</div>--}}
					{{--<div class="panel-body">--}}

						@include('errors.list')

						<form class="form-horizontal" role="form" method="POST" action="{!! URL::to('/pet/create') !!}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group">
								<label class="col-md-4 control-label">{{{ trans('pet.petname') }}}</label>

								<div class="col-md-6">
									<input type="text" class="form-control" name="petname" value="{{ old('petname') }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">{{{ trans('pet.kind') }}}</label>

								<div class="col-md-6">
									<select name="kind_id" class="form-control input-sm">
										@foreach ($kinds as $kind)
											<option value="{!!$kind->id!!}"> {!!$kind->name!!}</option>
										 @endforeach
									</select>
								</div>
							</div>	

							<div class="form-group">
								<label class="col-md-4 control-label">{{{ trans('pet.type') }}}</label>

								<div class="col-md-6">
									<select name="type_id" class="form-control input-sm">
										@foreach ($types as $type)
											<option value="{!!$type->id!!}"> {!!$type->name!!}</option>
										 @endforeach
									</select>
								</div>
							</div>	

							<div class="form-group">
								<label class="col-md-4 control-label">{{{ trans('pet.sex') }}}</label>

								<div class="col-md-6">
									<select name="sex"  class="form-control input-sm">
										<option value="male">male</option>
										<option value="female">female</option>
									</select>
								</div>
							</div>	

							<div class="form-group">
								<label class="col-md-4 control-label">{{{ trans('pet.born') }}}</label>

								<div class="col-md-6">
									<input type="text" class="form-control datepicker" name="born" value="{{ old('born') }}">
								</div>
							</div>	

							<div class="form-group">
								<label class="col-md-4 control-label">{{{ trans('pet.tall') }}}</label>

								<div class="col-md-6">
									<input type="text" class="form-control" name="tall" value="{{ old('tall') }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">{{{ trans('pet.weight') }}}</label>

								<div class="col-md-6">
									<input type="text" class="form-control" name="weight" value="{{ old('weight') }}">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Add
									</button>
								</div>
							</div>
						</form>
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
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
	</script>
@stop