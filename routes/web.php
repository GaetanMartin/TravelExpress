<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** 
 * Internationalization
 * Define a group that filter all pages that must be localized
 */
Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{

	// Routes for authentication
	Auth::routes();
	// Added get request to log out (only post by default)
	Route::get('/logout' , 'Auth\LoginController@logout');

	// Home
	Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/contact', 'HomeController@contact')->name('contact');
    Route::get('/', function(){
		return redirect('home');
	});

	// Ride search
	Route::get('/rides/search', 'TravelExpress\RidesController@search')->name('rides.search');
	Route::post('/rides/search', 'TravelExpress\RidesController@filter')->name('rides.filter');

    /**
	 * Routes where the user needs to be authentified
	 */
	Route::group(['middleware' => 'auth'], function()
	{
		// Preferences
		Route::get('/users/{user}/preferences', 'TravelExpress\PreferencesController@indexUser')->name('preferences_user');
		Route::resource('/preferences', 'TravelExpress\PreferencesController');

		// Cars
		Route::get('/users/{user}/cars', 'TravelExpress\CarsController@indexUser');
		Route::resource('/cars', 'TravelExpress\CarsController');

		// Rides
		Route::resource('/rides', 'TravelExpress\RidesController');

		// Bookings
		Route::get('/bookings/create/{rid}', 'TravelExpress\BookingsController@create')->name('bookings.create');
		Route::post('/bookings/store', 'TravelExpress\BookingsController@store')->name('bookings.store');
		Route::get('/bookings/index', 'TravelExpress\BookingsController@index')->name('bookings.index');
		Route::get('/bookings/show/{bid}', 'TravelExpress\BookingsController@show')->name('bookings.show');
		Route::get('bookings/accept/{bid}', 'TravelExpress\BookingsController@accept')->name('bookings.accept');
		Route::get('bookings/deny/{bid}', 'TravelExpress\BookingsController@deny')->name('bookings.deny');
		Route::any('bookings/pay/{bid}', 'TravelExpress\BookingsController@pay')->name('bookings.pay');

		// Notifications
		Route::get('/notifications', 'HomeController@notifications')->name('notifications');
	});

});