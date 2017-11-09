@extends('forms.default_form', ['form_title' => __('form.car_create')])

@include('forms.macros')

@section('form')
	{!! $car = null; !!}
    {{ Form::model($car, ['class' => 'form-horizontal', 'method'=> 'POST', 'route' => ['cars.store']]) }}
        @include('pages.cars.partial_form')        
    {{ Form::close() }}
@endsection