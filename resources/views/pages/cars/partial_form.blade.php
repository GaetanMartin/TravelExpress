{{-- Field make --}}
<div class="form-group{{ $errors->has('make') ? ' has-error' : '' }}">
    {{ Form::labelField('make', __('form.cars_label_make')) }}
    <div class="col-md-6">
        {{ Form::text('make', null, ['class' => 'form-control', 'required autofocus']) }}
        {!! Form::inputError('make', $errors) !!}
    </div>
</div>

{{-- Field model --}}
<div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
    {{ Form::labelField('model', __('form.cars_label_model')) }}
    <div class="col-md-6">
        {{ Form::text('model', null, ['class' => 'form-control', 'required autofocus']) }}
        {!! Form::inputError('model', $errors) !!}
    </div>
</div>

{{-- Field nb_seats --}}
<div class="form-group{{ $errors->has('nb_seats') ? ' has-error' : '' }}">
    {{ Form::labelField('nb_seats', __('form.cars_label_nb_seats')) }}
    <div class="col-md-6">
        {{ Form::number('nb_seats', null, ['class' => 'form-control', 'required autofocus']) }}
        {!! Form::inputError('nb_seats', $errors) !!}
    </div>
</div>

{{-- Submit --}}
<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {{ Form::submit(__('form.save'), ['class' => 'btn btn-primary']) }}
    </div>
</div>