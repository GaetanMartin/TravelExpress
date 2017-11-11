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
        $booking->fill($request->only(['ride_id', 'nb_seats_booked']));

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
        return View('pages.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
