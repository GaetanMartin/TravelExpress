<?php

namespace App\Http\Controllers\TravelExpress;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Ride;
use App\Model\City;
use App\Model\Preference;
use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Carbon\Carbon;

class RidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return redirect()->route('home');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Fetch all the cities
        $cities = City::select('city', 'id')->get();
        $luggage_sizes = Ride::getPossibleEnumValues('luggage_size');
        $car = Auth::user()->getCar();
        $locale = App::getLocale();
        return View('pages.rides.create', compact('cities', 'luggage_sizes', 'car', 'locale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Minus the driver
        $nbSeatsAvailable = Auth::user()->getCar()->nb_seats - 1;

        // Change this
        if ($request->input('source_city') == $request->input('dest_city')) {
            $request->session()->flash('status_danger', Lang::get('messages.flash_error_same_cities'));
            return redirect()->route('rides.create');
        }

        $this->validate($request, [
                'source_city' => 'required|integer',
                'dest_city' => 'required|integer',
                'nb_seats_offered' => 'required|min:1|max:'.$nbSeatsAvailable,
                'price' => 'required|numeric',
                'luggage_size' => 'required',
            ]);

        $ride = new Ride();
        $ride->car_id = Auth::user()->getCar()->id;
        $ride->fill($request->only(['nb_seats_offered', 'price', 'luggage_size']));

        $ride->start_time = Carbon::createFromFormat('d/m/Y H:i', $request->input('start_time'))->toDateTimeString();
        $ride->source_city_id = $request->input('source_city');
        $ride->dest_city_id = $request->input('dest_city');
        $ride->save();

        $request->session()->flash('status_success', Lang::get('messages.flash_ride_created'));
        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ride = Ride::findWithDetail($id);

        $ride->preference = new Preference($ride->smoker_accepted, $ride->pet_accepted, $ride->radio_accepted, $ride->chat_accepted);

        return View('pages.rides.show', compact('ride'));
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
