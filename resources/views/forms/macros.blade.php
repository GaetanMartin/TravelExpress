{{ Form::macro('labelField', function($name, $message) {
        return Form::label($name, $message, ['class' => 'col-md-4 control-label']); }) }}

{{ Form::macro('inputError', function($name, $errors) {
        
        $result = "";
        if (!empty($errors) && $errors->has($name)) {
            $result .= '<span class="help-block">';
            $result .= '<strong>'. $errors->first($name) . '</strong>';
            $result .= '</span>';
        }
        return $result;
    })
}}