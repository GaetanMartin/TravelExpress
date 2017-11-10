<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Ride;
use App\Model\Preference;
use Carbon\Carbon;
use App;
use Illuminate\Support\Facades\Lang;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Select last 1000 rides
        $rides = Ride::select('start_time', 'price', 'source_city.city as source_city', 
            'dest_city.city as dest_city', 'preferences.*', 'rides.nb_seats_offered', 
            'rides.luggage_size')
            ->join('cities as source_city', 'rides.source_city_id', 'source_city.id')
            ->join('cities as dest_city', 'rides.dest_city_id', 'dest_city.id')
            ->join('cars', 'rides.car_id', 'cars.id')
            ->join('users', 'cars.user_id', 'users.id')
            ->join('preferences', 'preferences.user_id', 'users.id')
            ->orderBy('rides.created_at', 'desc')
            ->whereDate('start_time', '>=', Carbon::today()->toDateString())
            ->take(1000)
            ->get();

        // Set preferences
        foreach ($rides as $ride) {
            $ride->preference = new Preference($ride->smoker_accepted, $ride->pet_accepted, $ride->radio_accepted, $ride->chat_accepted);
        }

        $locale = App::getLocale();

        return view('pages.home', compact('rides', 'locale'));
    }
    public function contact()
    {
        return view('pages.contact');
    }
}
