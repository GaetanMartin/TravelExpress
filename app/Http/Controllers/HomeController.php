<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Ride;
use App\Model\User;
use App\Model\Booking;
use App\Model\Preference;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App;
use DB;
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


    /**
     * Show the notifications dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function notifications() {

        $user_id = Auth::user()->id;

        $bookingsToBeAccepted = $this->constructPendingBookingsPerRide(Booking::getQueryPendingToBeAccepted($user_id)->get());

        $bookingsToBePaid = $this->constructPendingBookingsPerRide(Booking::getQueryPendingToBePaid($user_id)
            ->addSelect(DB::raw('(bookings.nb_seats_booked * rides.price) as total_price'))->get());

        return view('pages.notifications', compact('bookingsToBeAccepted', 'bookingsToBePaid'));
    }

    /**
     * Construct all the pending bookings
     *
     * @return \Illuminate\Http\Response
     */
    private function constructPendingBookingsPerRide($pendingBookings) {
        
        $coTravelersPendingIds = $pendingBookings->keyBy('requester_id')->keys();

        // $ridesIds = $pendingBookings->keyBy('ride_id')->keys();
        // $rides = Ride::getDetailQuery()->whereIn('rides.id', $ridesIds)->get();

        $users = User::whereIn('id', $coTravelersPendingIds)->get()->keyBy('id');


        foreach ($pendingBookings as $booking) {
            $booking->user = $users[$booking->requester_id];
            $booking->ride = Ride::findWithDetail($booking->ride_id);
        }

        return $pendingBookings;
    }
}
