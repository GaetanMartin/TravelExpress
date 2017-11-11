@extends('layouts.sidebar')

@section('content')

	<div class="well">

		<h1>@lang('messages.ride') #{{$ride->id }}</h1>

		<div class="container">
			<ul>
			   <li>@lang('messages.th_source_city') : {{$ride->source_city}}</li>
			   <li>@lang('messages.th_dest_city') : {{$ride->dest_city}}</li>
			   <li>@lang('messages.th_price') : {{$ride->price}}</li>
			   <li>@lang('messages.th_start_time') : {{$ride->start_time->format('d/m/Y H:i')}}</li>
			   <li>@lang('messages.th_nb_seats') : {{$ride->nb_seats_offered}}</li>
			   <li>@lang('messages.th_luggage_size') : {{__($ride->luggage_size)}}</li>
			</ul>

			@include('helpers.preferences.inline', ['preference'=> $ride->preference])
		</div>

		<br>

		<div class="container">
			<a href="{{ route('rides.create', $ride->id) }}" class="btn btn-info" role="button"><i class="fa fa-shopping-cart" aria-hidden="true"></i> @lang('messages.book')</a>
		</div>

		
	</div>

@endsection