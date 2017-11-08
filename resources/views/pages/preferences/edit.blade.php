@extends('layouts.default')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('form.preference_edit')</div>

                <div class="panel-body">
                    {{ Form::model($preference, ['method'=> 'PATCH', 'route' => ['preferences.update', $preference->id]]) }}
                        <div class="form-check">
                            <i class="fa fa-fire"></i>
                            {{ Form::checkbox('smoker_accepted') }}
                            {{ Form::label('smoker_accepted', __('form.preference_smoker_accepted'), ['class' => 'form-check-label']) }}
                        </div>
                        <div class="form-check">
                            <i class="fa fa-paw"></i>
                            {{ Form::checkbox('pet_accepted') }}
                            {{ Form::label('pet_accepted', __('form.preference_pet_accepted'), ['class' => 'form-check-label']) }}
                        </div>
                        <div class="form-check">
                            <i class="fa fa-music"></i>
                            {{ Form::checkbox('radio_accepted') }}
                            {{ Form::label('radio_accepted', __('form.preference_radio_accepted'), ['class' => 'form-check-label']) }}
                        </div>
                        <div class="form-check">
                            <i class="fa fa-comments"></i>
                            {{ Form::checkbox('chat_accepted') }}
                            {{ Form::label('chat_accepted', __('form.preference_chat_accepted'), ['class' => 'form-check-label']) }}
                        </div>
                        {{ Form::submit(__('form.save'), ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection