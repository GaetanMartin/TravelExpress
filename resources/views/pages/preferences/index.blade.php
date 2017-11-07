@extends('layouts.default')

@section('content')

	<div class="well">
		<h1>Preferences</h1>

		<h3>{{ $user->getName() }}</h3>

		<div>
			@include('helpers.preferences.inline', compact('preference'))
		</div>

		@if($user == Auth::user())
			<a href="{{ route('preferences.edit', $preference->id) }}">Edit</a>
		@endif

	</div>

@endsection