@extends('app')
@section('title') Home :: @parent @stop
@section('content')
	<div class="row">
		<div class="page-header">
			<h2>Pet</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<a href="{{URL::to('pet/create')}}">Add a Pet</a>
		</div>
	</div>
	@if(count($mypets)>0)
		<div class="row">
			<h2>My Pets</h2>
			@foreach ($mypets as $pet)
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-8">
							<h4>
								<strong><a href="{{URL::to('pet/show/'.$pet->id.'')}}">{!! $pet->name !!}</a></strong>
							</h4>
						</div>
					</div>
				</div>
			@endforeach
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
