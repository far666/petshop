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

			<form class="form-horizontal" role="form" method="POST" action="{!! URL::to('/recode/create') !!}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.service') }}}</label>

					<div class="col-md-6">
						<select name="service" class="form-control input-sm">
							@foreach ($services as $key =>$service)
								<option value="{{{$key}}}">{{{$service}}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.pet') }}}</label>

					<div class="col-md-6">
						<select name="pet_id" class="form-control input-sm">
							@foreach ($pets as $pet)
								<option value="{{{$pet->id}}}">{{{$pet->name}}}</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('pet.service_date') }}}</label>

					<div class="col-md-6">
						<input type="text" class="form-control datepicker" name="service_date" value="{{ old('service_date') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">{{{ trans('recode.payment_method') }}}</label>

					<div class="col-md-6">
						<select name="payment" class="form-control input-sm">
							@foreach ($payment_method as $key=>$method)
								<option value="{{{$key}}}">{{{$method}}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn btn-primary">
							{{{ trans('recode.reserve') }}}
						</button>
					</div>
				</div>
			</form>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div id="calendar" class="col-md-8"></div>
		</div>
	</div>
		
	
@endsection


{{-- Scripts --}}
@section('scripts') 
	<script src="{{asset('js/date-time/bootstrap-datepicker.min.js')}}"></script>
	<!-- calender -->
	<link rel='stylesheet' href="{{asset('js/fullcalendar/fullcalendar.css')}}" />
	<script src="{{asset('js/fullcalendar/lib/moment.min.js')}}"></script>
	<script src="{{asset('js/fullcalendar/fullcalendar.js')}}"></script>

	<script type="text/javascript">
		$(function(){
			$('.datepicker').datepicker();
			$('#calendar').fullCalendar({
				// put your options and callbacks here
				 // weekends: false,
			});

			var view = $('#calendar').fullCalendar('getView');

			start = view.start.format();
			AllReserveStatus(start,42);

			$('.fc-button').click(function(){
				start = view.start.format();
				AllReserveStatus(start,42);
			});	
		});

		function AllReserveStatus(first_date,number){
			console.log(first_date);
			console.log(number);
			
			$.ajax({
				url: "{!! URL::to('/admin/recodes/reserve_status') !!}",
				type: "post",
				dataType: "json",
				data:{
					'first_date' : first_date,
					'number' : number,
					'_token' : '{{csrf_token()}}'
				},
				async: false,
				cache: false,
				success: function(data) {
					if(data.msg){
						alert(data.msg);
						return;
					}
					console.log(data);
					var all_events = [];
					$.each(data,function(index,data){
						all_events.push({
							title:data.title,
							start:data.date,
							backgroundColor:data.color,
						});
					});
					console.log(all_events);

					var source = {
						events: all_events,
						// color: 'yellow',   // an option!
						textColor: 'black' // an option!
					};

					$('#calendar').fullCalendar( 'removeEvents');
					$('#calendar').fullCalendar( 'addEventSource', source );
				},
				error: function() {
					console.log("Error!");
				}
			});
		}
	</script>
@stop