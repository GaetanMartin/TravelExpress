@extends('layouts.default')

@section('content')


<h1>@lang('messages.h1_latest_rides')</h1>

@include('includes.rides_datatables', ['rides'=> $rides, 'locale' => $locale])

@endsection