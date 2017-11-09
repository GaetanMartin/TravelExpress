@extends('layouts.default')

@section('content')
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