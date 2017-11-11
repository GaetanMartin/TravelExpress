@extends('forms.default_form', ['form_title' => __('form.booking_create')])

@include('forms.macros')

@section('form')
	{!! $booking = null; !!}

    	<div class="form-group">
    		<ul>
			   <li>@lang('messages.th_source_city'): {{$ride->source_city}}</li>
			   <li>@lang('messages.th_dest_city'): {{$ride->dest_city}}</li>
			   <li>@lang('messages.th_price'): {{$ride->price}}</li>
			   <li>@lang('messages.th_start_time'): {{$ride->start_time->format('d/m/Y H:i')}}</li>
			   <li>@lang('messages.th_nb_seats'): {{$ride->nb_seats_offered}}</li>
			   <li>@lang('messages.th_luggage_size'): {{__($ride->luggage_size)}}</li>
			   <li>@include('helpers.preferences.inline', ['preference'=> $ride->preference])</li>
			   <li><strong>@lang('messages.rides_nb_seats_remaining'): {{$ride->nbSeatsAvailable}}</strong></li>
			</ul>
    	</div>

    {{ Form::model($booking, ['class' => 'form-horizontal', 'method'=> 'POST', 'route' => ['bookings.store']]) }}

    	{{ Form::hidden('ride_id', $ride->id) }}

    	{{-- Field nb_seats offered --}}
    	<div class="form-group{{ $errors->has('nb_seats_booked') ? ' has-error' : '' }}">
    	    {{ Form::labelField('nb_seats_booked', __('form.label_nb_seats_booked')) }}
    	    <div class="col-md-2">
    	        {{ Form::number('nb_seats_booked', null, ['class' => 'form-control', 'required autofocus value=1 min=1 max='. ($ride->nbSeatsAvailable) ]) }}
    	        {!! Form::inputError('nb_seats_booked', $errors) !!}
    	    </div>
    	</div>

    	{{-- Submit --}}
    	<div class="form-group">
    	    <div class="col-md-6 col-md-offset-4">
    	        {{ Form::submit(__('messages.book'), ['class' => 'btn btn-primary']) }}
    	    </div>
    	</div>

    {{ Form::close() }}
@endsection