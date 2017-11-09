@extends('layouts.default')

@section('content')


{{ Form::macro('labelField', function($name, $message) {
        return Form::label($name, $message, ['class' => 'col-md-4 control-label']); }) }}

{{
    Form::macro('inputError', function($name, $errors) {
        
        $result = "";
        if (!empty($errors) && $errors->has($name)) {
            $result .= '<span class="help-block">';
            $result .= '<strong>'. $errors->first($name) . '</strong>';
            $result .= '</span>';
        }
        return $result;
    })
}}


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>{{ $form_title }}</strong></div>
                <div class="panel-body">
                    @yield('form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection