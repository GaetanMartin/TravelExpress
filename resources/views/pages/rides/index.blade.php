@extends('layouts.default')

@section('content')

	<div class="well">
		<h1>@lang('messages.cars_your_cars', ['user' => $user->getName()])</h1>

		@if(empty($car))
			<a href="{{ route('cars.create')}}">@lang('messages.cars_no_car_yet')</a>
		@else
			<div>
				<ol>
					<li><i class="fa fa-car" aria-hidden="true"></i> {{ $car->make }} {{ $car->model }} (@lang('messages.cars_nb_seats', ['nb_seats' => $car->nb_seats]))</li>
				</ol>
			</div>

			<br>
			
			@if($user == Auth::user())
				<a href="{{ route('cars.edit', $car->id) }}" class="btn btn-info" role="button"><i class="fa fa-pencil" aria-hidden="true"></i> @lang('messages.cars_edit')</a>
			@endif

		@endif

	</div>

@endsection