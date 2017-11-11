@extends('layouts.sidebar')

@section('content')

	<div class="well">

		<h1>@lang('messages.your_bookings')</h1>

		<div class="container">
			<ul>
				@foreach($bookings as $booking)
			   		<li>
			   			<a href="{{ route('bookings.show', $booking->id) }}"> 
			   				#{{ $booking->id }} </a> - {{ $booking->created_at->format('d/m/Y') }} - 
			   			<a href="{{ route('rides.show', $booking->ride_id) }}">@lang('messages.ride')#{{ $booking->ride_id }}</a>
			   		</li>
			    @endforeach
			</ul>
		</div>

		<br>

		
	</div>

@endsection