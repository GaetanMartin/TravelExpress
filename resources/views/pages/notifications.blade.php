@extends('layouts.sidebar')
@section('content')
    <h1>Notifications</h1>

    @if( Auth::user()->getNbNotifications() > 0)

	    <h2>Pending Passengers</h2>
	    <div class="row">

	    	<ul class="list-group">
  
	    		@foreach($bookings as $booking)
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

	    <h2>Pending Ride's Payment</h2>
	    <div class="container">
	    	
	    </div>

    @else

    	<p>You don't have any notifications</p>

    @endif
@stop