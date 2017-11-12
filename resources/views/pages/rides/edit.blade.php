@extends('forms.default_form', ['form_title' => __('form.ride_update')])

@include('forms.macros')

@section('form')
    {{ Form::model($ride, ['class' => 'form-horizontal', 'method'=> 'PATCH', 'route' => ['rides.update', $ride->id]]) }}
        @include('pages.rides.partial_form')        
    {{ Form::close() }}
@endsection