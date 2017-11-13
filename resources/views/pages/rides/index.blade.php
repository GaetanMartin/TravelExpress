@extends('layouts.sidebar')

@section('content')

		<h1>@lang('messages.your_rides')</h1>

		@if(count($rides))
    	<div class="">
		    <div class="row">

		    	<ul class="list-group">
		    		@foreach($rides as $ride)
		  				<li class="list-group-item d-flex justify-content-between align-items-center">
		  				<a href="{{ route('rides.show', $ride->id) }}">{{$ride->start_time->format('d/m/Y H:i')}} : {{$ride->source_city}} -> {{$ride->dest_city}}</a> 
		    		@endforeach
	  				</li>
				</ul>
		    </div>
		</div>
		@else
			<p>@lang('messages.no_rides_yet')</p>
		@endif

@endsection