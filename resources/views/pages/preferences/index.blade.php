@extends('layouts.default')

@section('content')

	<div class="well">
		<h1>@lang('messages.preferences')</h1>

		<h2>{{ $user->getName() }}</h2>

		<div>
			@include('helpers.preferences.inline', compact('preference'))
		</div>

		<br>
		
		@if($user == Auth::user())
			<a href="{{ route('preferences.edit', $preference->id) }}" class="btn btn-info" role="button"><i class="fa fa-pencil" aria-hidden="true"></i> @lang('messages.preferences_edit')</a>
		@endif

	</div>

@endsection