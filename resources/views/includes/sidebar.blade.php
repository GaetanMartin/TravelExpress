<div class="text-center">
	<nav id="sidebar-nav">
	    <ul class="nav nav-pills nav-stacked nav-tabs">
	        <li>
	        	<a href="{{ route('bookings.index') }}"><i class="fa fa-book fa-fw" aria-hidden="true"></i> @lang('messages.your_bookings')</a>
	        </li>
	        <li>
	        	<a href="{{ route('rides.index') }}"><i class="fa fa-list" aria-hidden="true"></i> @lang('messages.your_rides')</a>
        	</li>
        	<li>
	        	<a href="{{ route('preferences.index') }}"><i class="fa fa-check-square-o" aria-hidden="true"></i> @lang('layouts.nav_menu_preferences')</a>
        	</li>
	    </ul>
	</nav>
</div>