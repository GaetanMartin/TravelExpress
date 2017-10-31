 <!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
             <a id="nav_title" class="navbar-brand" href="{{url('/home')}}"><i class="fa fa-car" aria-hidden="true"></i> @lang('layouts.website_name')</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('home') ? 'active' : '' }}"><a href="{{url('/home')}}"><i class="fa fa-home" aria-hidden="true"></i> @lang('layouts.nav_menu_home')</a></li>
                <li class="{{ Request::is('search') ? 'active' : '' }}"><a href="{{url('/trip/search')}}"><i class="fa fa-search" aria-hidden="true"></i> @lang('layouts.nav_menu_trip_search')</a></li>
                <li class="{{ Request::is('trip') ? 'active' : '' }}"><a href="{{url('/trip/new')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> @lang('layouts.nav_menu_trip_new')</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="{{url('contact')}}"><i class="fa fa-envelope-o" aria-hidden="true"></i> @lang('layouts.nav_menu_contact')</a></li>
            	
            	@guest
            		{{-- Visitor --}}
            		<li><a href="{{url('/login')}}"><i class="fa fa-user" aria-hidden="true"></i> @lang('layouts.nav_menu_login')</a></li>
                    <li><a href="{{ route('register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> @lang('layouts.nav_menu_register')</a></li>
            	@else
            		{{-- Logged In --}}
            		<li><a href="{{url('/logout')}}"><i class="fa fa-power-off" aria-hidden="true"></i> @lang('layouts.nav_menu_logout')</a></li>
            	@endguest
            </ul>
        </div>
    </div>
</nav>
<!-- End Nav Bar -->