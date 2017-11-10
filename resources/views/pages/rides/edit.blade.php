@extends('forms.default_form', ['form_title' => __('form.car_edit')])

@include('forms.macros')

@section('form')
    {{ Form::model($car, ['class' => 'form-horizontal', 'method'=> 'PATCH', 'route' => ['cars.update', $car->id]]) }}
        @include('pages.cars.partial_form')        
    {{ Form::close() }}
@endsection