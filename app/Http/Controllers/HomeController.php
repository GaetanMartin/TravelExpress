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
        $rides = Ride::getDetailQuery()
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
