@extends('layouts.default')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('form.preference_edit')</div>

                <div class="panel-body">
                    {{-- {{ Form::open(['method' => 'PATCH', 'route' => ['preferences.update', $preference->id]]) }} --}}
                    {{ Form::model($preference, ['method'=> 'PATCH', 'route' => ['preferences.update', $preference->id]]) }}
                        {{ Form::checkbox('smoker_accepted') }}
                        {{ Form::checkbox('pet_accepted') }}
                        {{ Form::checkbox('radio_accepted') }}
                        {{ Form::checkbox('chat_accepted') }}
                        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
