@extends('layouts.sidebar')
@section('content')
    <h1>Notifications</h1>

    @if( Auth::user()->getNbNotifications() > 0)

    	@if(count($bookingsToBeAccepted))
    	<div class="">
		    <h2>@lang('messages.pending_passengers')</h2>
		    <div class="row">

		    	<ul class="list-group">
		    		@foreach($bookingsToBeAccepted as $booking)
		  				<li class="list-group-item d-flex justify-content-between align-items-center">
		  				<a href="{{ route('rides.show', $booking->ride_id) }}">{{$booking->ride->start_time->format('d/m/Y H:i')}} : {{$booking->ride->source_city}} -> {{$booking->ride->dest_city}}</a> 
		  					<span class="badge badge-primary badge-pill">{{ $booking->nb_seats_booked }} @lang('messages.seats')</span>
		  					<br>
		  					<a href="{{ route('preferences_user', $booking->user->id) }}">{{ $booking->user->getName()}}</a>
		  					<br>
		  					@include('helpers.preferences.inline', ['preference'=> $booking->user->getPreference()])
		  					<br>
							<div class="btn-group">
								<div class="btn-group">
									<a href="{{ route('bookings.accept', ['id' => $booking->id]) }}" class="btn btn-success" role="button"><i class="fa fa-check" aria-hidden="true"></i> @lang('messages.accept')</a>
								</div>
								<div class="btn-group">
									<a href="{{ route('bookings.deny', ['id' => $booking->id]) }}" class="btn btn-danger" role="button"><i class="fa fa-times" aria-hidden="true"></i> @lang('messages.deny')</a>
					            </div>
				        	</div>
		    		@endforeach
	  				</li>
				</ul>
		    </div>
		</div>
		@endif

		@if(count($bookingsToBePaid))
		<div class="">
		    <h2>@lang('messages.pending_payments')</h2>
		    <div class="row">

		    	<ul class="list-group">
	  
		    		@foreach($bookingsToBePaid as $booking)
		  				<li class="list-group-item d-flex justify-content-between align-items-center">
		  				<a href="{{ route('rides.show', $booking->ride_id) }}">{{$booking->ride->start_time->format('d/m/Y H:i')}} : {{$booking->ride->source_city}} -> {{$booking->ride->dest_city}}</a> 
		  					<span class="badge badge-primary badge-pill">{{ $booking->nb_seats_booked }} @lang('messages.seats')</span>
		  					<br>
		  					<span>@lang('messages.total_price'): <strong>{{ $booking->total_price + 0}}$</strong></span>
		  					<br>
							<div class="btn-group">
								<div class="btn-group">
									<a href="{{ route('bookings.payment', ['id' => $booking->id]) }}" class="btn btn-info" role="button"><i class="fa fa-check" aria-hidden="true"></i> @lang('messages.pay')</a>
								</div>
								<div class="btn-group">
									<a href="{{ route('bookings.cancel', ['id' => $booking->id]) }}" class="btn btn-danger" role="button"><i class="fa fa-times" aria-hidden="true"></i> @lang('messages.cancel')</a>
					            </div>
				        	</div>
		    		@endforeach
	  				</li>
				</ul>
		    </div>
		</div>
		@endif

    @else

    	<p>@lang('messages.no_notifications')</p>

    @endif
@stop