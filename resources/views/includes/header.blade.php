 <!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu_navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
             <a id="nav_title" class="navbar-brand" href="{{url('/')}}"><i class="fa fa-car" aria-hidden="true"></i> @lang('layouts.website_name')</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i> @lang('layouts.nav_menu_home')</a></li>
                <li class="{{ Request::is('/trip/search') ? 'active' : '' }}"><a href="{{url('/trip/search')}}"><i class="fa fa-search" aria-hidden="true"></i> @lang('layouts.nav_menu_trip_search')</a></li>
                <li class="{{ Request::is('/trip/new') ? 'active' : '' }}"><a href="{{url('/trip/new')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> @lang('layouts.nav_menu_trip_new')</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ Request::is('/contact') ? 'active' : '' }}"><a href="{{url('contact')}}"><i class="fa fa-envelope-o" aria-hidden="true"></i> @lang('layouts.nav_menu_contact')</a></li>
            	
            	@if (Auth::check())
            		{{-- Logged In --}}
            		<li><a href="{{url('/login')}}"><i class="fa fa-power-off" aria-hidden="true"></i> @lang('layouts.nav_menu_logout')</a></li>
            	@else
            		{{-- Visitor --}}
            		<li><a href="{{url('/logout')}}"><i class="fa fa-user" aria-hidden="true"></i> @lang('layouts.nav_menu_login')</a></li>
            	@endif
            </ul>
        </div>
    </div>
</nav>
<!-- End Nav Bar -->