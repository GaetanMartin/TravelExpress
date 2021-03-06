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
     * Display the form advanced search
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $luggage_sizes = Ride::getPossibleEnumValues('luggage_size');
        $locale = App::getLocale();
        $cities = City::select('city', 'id')->get();
        return View('pages.rides.search', compact('luggage_sizes', 'locale', 'cities'));
    }

    /**
     * Search and display the results
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {

        $this->validate($request, [
                'source_city' => 'required|integer',
                'dest_city' => 'required|integer',
                'nb_seats_offered' => 'required|min:1|max:10',
            ]);

        $rq = Ride::getDetailQuery();

        if ($request->has('source_city')) {
            $rq->where('source_city_id', $request->input('source_city'));
        }

        if ($request->has('dest_city')) {
            $rq->where('dest_city_id', $request->input('dest_city'));
        }

        if ($request->has('nb_seats_offered')) {
            $rq->where('nb_seats_offered', '>=' , $request->input('nb_seats_offered'));
        }

        if ($request->has('price_range')) {        
            if (strpos($request->input('price_range'), ',')) {
                $price_range = explode(',', $request->input('price_range'));
                sort($price_range);
                $price_min = $price_range[0];
                $price_max = $price_range[1];
                $rq->where('price', '>=', $price_min);
                $rq->where('price', '<=', $price_max);
            }
        }




        if ($request->has('start_time_from')) {
            $start_time_from = Carbon::createFromFormat('d/m/Y H:i', $request->input('start_time_from'))->toDateTimeString();
            $rq->whereDate('start_time', '>=', $start_time_from);
        }

        if ($request->has('start_time_to')) {   
            $start_time_to = Carbon::createFromFormat('d/m/Y H:i', $request->input('start_time_to'))->toDateTimeString();
            $rq->whereDate('start_time', '<=', $start_time_to);
        }

        if ($request->has('luggage_size')) {
            $minSize = $request->input('luggage_size');
            $acceptable_sizes = ['messages.small'];
            if ($minSize == 'messages.medium') {
                $acceptable_sizes[] = 'messages.medium';
            }
            if ($minSize == 'messages.large') {
                $acceptable_sizes[] = 'messages.medium';
                $acceptable_sizes[] = 'messages.large';
            }
            $rq->whereIn('luggage_size', $acceptable_sizes);
        }

        // print_r($request->input('nb_seats_offered'));
        // print_r($request->input('dest_city'));
        // die;

        $rides = $rq->get();

        // Set preferences
        foreach ($rides as $ride) {
            $ride->preference = new Preference($ride->smoker_accepted, $ride->pet_accepted, $ride->radio_accepted, $ride->chat_accepted);
        }

        $locale = App::getLocale();

        return view('pages.rides.search_result', compact('rides', 'locale'));
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $rides = Ride::getDetailQuery()->where('users.id', $user_id)->get();
        return view('pages.rides.index', compact('rides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $car = Auth::user()->getCar();

        if ($car == null) {
            $request->session()->flash('status_danger', Lang::get('messages.flash_error_create_car'));
            return redirect()->route('cars.create');         
        }

        // Fetch all the cities
        $cities = City::orderBy('city')->pluck('city', 'id');
        $luggage_sizes = Ride::getPossibleEnumValues('luggage_size');
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
        $this->check($request);

        $ride = $this->fillRide(new Ride(), $request);
        $ride->save();
        $date_init = $ride->start_time;
        $id = $ride->id;

        $nbRides = $this->manageFrequency($request, $date_init) + 1; // Plus init one

        $request->session()->flash('status_success', Lang::get('messages.flash_ride_created'));
        return redirect()->route('rides.index');
    }

    private function manageFrequency(Request $request, Carbon $date_init) {

        $nbRides = 0;

        if (!$request->has('frequency', 'frequency_value')) {
            return 0;
        }
        $frequency = $request->input('frequency');
        $frequency_value = min($request->input('frequency_value'), 12);

        for ($i=0; $i < $frequency_value; $i++) {
            $ride = $this->fillRide(new Ride(), $request);
            switch ($frequency) {
                case 'd':
                    $date_init->addDay();
                    break;
                case 'w':
                    $date_init->addWeek();
                    break;
                case 'm':
                    $date_init->addMonth();
                    break;
                default: 
                    return;
            }
            $ride->start_time = $date_init;
            $ride->save();
            $nbRides ++;
        }

        return $nbRides;
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

        if (! empty($car = Auth::user()->getCar())) {
            $rideOfConnectedUser = ($car->id == $ride->car_id);
        } else {
            $rideOfConnectedUser = false;
        }

        // Indicates if the current ride is the one of the connected user

        return View('pages.rides.show', compact('ride', 'rideOfConnectedUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $car = $user->getCar();
        $ride = Ride::where('car_id', $car->id)->findOrFail($id);
        $cities = City::orderBy('city')->pluck('city', 'id');
        $luggage_sizes = Ride::getPossibleEnumValues('luggage_size');
        $locale = App::getLocale();
        return View('pages.rides.edit', compact('ride', 'cities', 'luggage_sizes', 'car', 'locale'));
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
        $this->check($request);
        $car_id = Auth::user()->getCar()->id;
        $ride = Ride::where('car_id', $car_id)->findOrFail($id);
        $this->fillRide($ride, $request)->save();

        $request->session()->flash('status_success', Lang::get('messages.flash_ride_updated'));

        return redirect()->route('rides.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $car_id = Auth::user()->getCar()->id;
        $ride = Ride::where('car_id', $car_id)->findOrFail($id);
        $ride->delete();

        $request->session()->flash('status_success', Lang::get('messages.flash_ride_destroyed'));
        return redirect()->route('home');
    }

    private function check(Request $request) {
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
    }

    private function fillRide(Ride $ride, Request $request) {
        $ride->car_id = Auth::user()->getCar()->id;
        $ride->fill($request->only(['nb_seats_offered', 'price', 'luggage_size']));

        $ride->start_time = Carbon::createFromFormat('d/m/Y H:i', $request->input('start_time'))->toDateTimeString();
        $ride->source_city_id = $request->input('source_city');
        $ride->dest_city_id = $request->input('dest_city');
        
        return $ride;
    }
}
