@extends('layouts.sidebar')

@section('content')

		<h1>@lang('messages.your_bookings')</h1>

		@if(count($bookings))
		<div class="">
		    <div class="row">
		    	<ul class="list-group">
				@foreach($bookings as $booking)
			   		<li class="list-group-item {{$booking->status_color}} d-flex justify-content-between align-items-center">
			   			<a href="{{ route('bookings.show', $booking->id) }}"> 
			   				#{{ $booking->id }} </a> - {{ $booking->created_at->format('d/m/Y') }} - 
			   			<a href="{{ route('rides.show', $booking->ride_id) }}">@lang('messages.ride')#{{ $booking->ride_id }}</a>
			   		</li>
			    @endforeach
				</ul>
			</div>
		</div>
		@else
			<p>@lang('messages.no_bookings_yet')</p>
		@endif

@endsection