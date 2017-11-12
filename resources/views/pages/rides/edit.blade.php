@extends('forms.default_form', ['form_title' => __('form.ride_update')])

@include('forms.macros')

@section('form')
    {{ Form::model($ride, ['class' => 'form-horizontal', 'method'=> 'PATCH', 'route' => ['rides.update', $ride->id]]) }}
        @include('pages.rides.partial_form')

        {{-- Submit --}}
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                {{ Form::submit(__('form.save'), ['class' => 'btn btn-primary']) }}
            </div>
        </div>

    {{ Form::close() }}
@endsection