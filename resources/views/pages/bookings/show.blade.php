@extends('layouts.sidebar')

@section('content')


	<h1>@lang('messages.booking') #{{ $booking->id }}</h1> 

	<div class="well">
		{{ $booking->created_at->format('d/m/Y') }} - 
			<a href="{{ route('rides.show', $booking->ride_id) }}">@lang('messages.ride')#{{ $booking->ride_id }}</a>
	</div>

@endsection