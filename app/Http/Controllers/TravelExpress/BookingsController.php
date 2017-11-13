<?php

namespace App\Http\Controllers\TravelExpress;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Ride;
use App\Model\City;
use App\Model\Preference;
use App\Model\Booking;
use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Carbon\Carbon;

class BookingsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::where('requester_id', Auth::user()->id)->get();
        return View('pages.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $ride = Ride::findWithDetail($id);
        $ride->nbSeatsAvailable = Ride::getNbSeatsAvailable($id);
        $ride->preference = new Preference($ride->smoker_accepted, $ride->pet_accepted, $ride->radio_accepted, $ride->chat_accepted);
        return View('pages.bookings.create', compact('ride'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $nbSeatsAvailable = Ride::getNbSeatsAvailable($request->input('ride_id'));

        $this->validate($request, [
                'nb_seats_booked' => 'required|integer|min:1|max:'.$nbSeatsAvailable,
                'ride_id' => 'required|integer',
            ]);

        $booking = new Booking();
        $booking->requester_id = Auth::user()->id;
        $booking->status = 'messages.pending';
        $booking->ride_id = $request->input('ride_id');
        $booking->nb_seats_booked = $request->input('nb_seats_booked');
        $booking->save();

        $request->session()->flash('status_success', Lang::get('messages.flash_booking_created'));

        return redirect()->route('bookings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        // TODO
        return View('pages.bookings.show', compact('booking'));
    }


    public function pay(Request $request, $id) {
        $user_id = Auth::user()->id;

        $booking = Booking::where('requester_id', $user_id)->where('status', 'messages.accepted')->findOrFail($id);
        $booking->status = 'messages.confirmed';
        $booking->save();

        $request->session()->flash('status_success', Lang::get('messages.flash_booking_paid'));
        return redirect()->route('bookings.index');
    }

    public function accept(Request $request, $id) {

        if (null == ($booking = $this->getBookingSafely($id))) {
            return redirect()->route('home');
        }

        // Check available seats
        if (Ride::getNbSeatsAvailable($booking->ride_id) < $booking->nb_seats_booked) {
            $booking->status = 'messages.denied';
            $request->session()->flash('status_danger', Lang::get('messages.flash_not_enough_room_booking_denied'));
        } else {
            $booking->status = 'messages.accepted';
            $request->session()->flash('status_success', Lang::get('messages.flash_booking_accepted'));
        }

        $booking->save();
        return redirect()->route('notifications');
    }

    public function deny(Request $request, $id) {
        if (null == ($booking = $this->getBookingSafely($id))) {
            return redirect()->route('home');
        }
        $booking->status = 'messages.denied';
        $booking->save();

        $request->session()->flash('status_success', Lang::get('messages.flash_booking_denied'));
        return redirect()->route('notifications');
    }

    private function getBookingSafely($id) {
        $car = Auth::user()->getCar();
        if ($car == null) {
            return null;
        }
        return Booking::getVerifyingCar($id, $car->id);
    }
}
