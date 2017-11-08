@extends('layouts.default')

@section('content')

	<div class="well">
		<h1>@lang('messages.preferences')</h1>

		<h3>{{ $user->getName() }}</h3>

		<div>
			@include('helpers.preferences.inline', compact('preference'))
		</div>

		@if($user == Auth::user())
			<a href="{{ route('preferences.edit', $preference->id) }}" class="btn btn-info" role="button"><i class="fa fa-pencil" aria-hidden="true"></i> @lang('messages.preferences_edit')</a>
		@endif

	</div>

@endsection