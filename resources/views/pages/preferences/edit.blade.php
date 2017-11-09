@extends('forms.default_form', ['form_title' => __('form.preference_edit')])

@section('form')

{{ Form::macro('labelField', function($name, $message) {
        return Form::label($name, $message, ['class' => 'form-check-label']); }) }}

{{ Form::macro('inputField', function($name) {
        return Form::checkbox($name); }) }}

{{ Form::macro('labelAndInput', function($name, $labelMessage) {
        return Form::inputField($name) . ' ' . Form::labelField($name, $labelMessage); }) }}

{{ Form::macro('inputFull', function($name, $faIcon) {

        $translateMsg = 'form.preference_' . $name;

        $result = '<div class="form-check">';
        $result .= '<i class="' . $faIcon . '"></i> ';
        $result .= Form::labelAndInput($name, __($translateMsg));
        $result .= '</div>';

        return $result;
}) }}

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{ Form::model($preference, ['method'=> 'PATCH', 'route' => ['preferences.update', $preference->id]]) }}
    {!! Form::inputFull('smoker_accepted', 'fa fa-fire') !!}
    {!! Form::inputFull('pet_accepted', 'fa fa-paw') !!}
    {!! Form::inputFull('radio_accepted', 'fa fa-music') !!}
    {!! Form::inputFull('chat_accepted', 'fa fa-comments') !!}
    {{ Form::submit(__('form.save'), ['class' => 'btn btn-primary']) }}
{{ Form::close() }}

@endsection