@extends('forms.default_form', ['form_title' => __('form.ride_create')])

@include('forms.macros')

@section('form')
	{!! $ride = null; !!}
    {{ Form::model($ride, ['class' => 'form-horizontal', 'method'=> 'POST', 'route' => ['rides.store']]) }}
        @include('pages.rides.partial_form')        
    {{ Form::close() }}
@endsection