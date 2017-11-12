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
			<div class="btn-group">
			@if($rideOfConnectedUser)
				<div class="btn-group">
					<a href="{{ route('rides.edit', ['id' => $ride->id]) }}" class="btn btn-info" role="button"><i class="fa fa-pencil" aria-hidden="true"></i> @lang('messages.edit')</a>
				</div>
				<div class="btn-group">
					{{ Form::open([ 'method'  => 'delete', 'route' => [ 'rides.destroy', $ride->id ], 'class' => '']) }}
						<button type="submit" class="btn btn-danger">
							<i class="fa fa-trash-o"></i> @lang('messages.delete')
						</button>
	                {{ Form::close() }}
	            </div>
			@else
				<div class="btn-group">
					<a href="{{ route('bookings.create', ['id' => $ride->id]) }}" class="btn btn-info" role="button"><i class="fa fa-shopping-cart" aria-hidden="true"></i> @lang('messages.book')</a>
				</div>
			@endif
			</div>
		</div>


		
	</div>

@endsection