@extends('layouts.sidebar')

@section('content')


	<h1>@lang('messages.booking') #{{ $booking->id }}</h1> 

	<h2>
		{{ $booking->created_at->format('d/m/Y') }} - 
			<a href="{{ route('rides.show', $booking->ride_id) }}">@lang('messages.ride')#{{ $booking->ride_id }}</a>
	</h2>
	<div class="well">
		<ul>
			<li><strong>@lang($booking->status)</strong></li>
			<li><i class="fa fa-id-card-o" aria-hidden="true"></i> {{ $ride->driver_first_name }} {{ $ride->driver_last_name }}</li>
		    <li>@lang('messages.th_source_city') : {{$ride->source_city}}</li>
		    <li>@lang('messages.th_dest_city') : {{$ride->dest_city}}</li>
		    <li>@lang('messages.th_price') : {{$ride->price}}</li>
		    <li>@lang('messages.th_start_time') : {{$ride->start_time->format('d/m/Y H:i')}}</li>
		    <li>@lang('messages.th_nb_seats') : {{$nbSeatsAvailable = $ride->getNbSeatsAvailable($ride->id)}} / {{$ride->nb_seats_offered}}</li>
		    <li>@lang('messages.th_luggage_size') : {{__($ride->luggage_size)}}</li>
		</ul>

		@if($booking->status == 'messages.accepted')
		<a href="{{ route('bookings.payment', ['id' => $booking->id]) }}" class="btn btn-info" role="button"><i class="fa fa-check" aria-hidden="true"></i> @lang('messages.pay')</a>
		@endif

		@include('helpers.preferences.inline', ['preference'=> $ride->preference])
	</div>


@endsection