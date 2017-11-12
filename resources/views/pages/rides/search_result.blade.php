@extends('layouts.default')

@section('content')

<h1 class="text-center">@lang('messages.search_result')</h1>

@include('includes.rides_datatables', ['rides'=> $rides, 'locale' => $locale])

@endsection