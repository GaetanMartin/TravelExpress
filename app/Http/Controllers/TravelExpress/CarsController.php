<?php
/**
 * Created by PhpStorm.
 * User: Gaetan
 * Date: 24/10/2017
 * Time: 16:20
 */

namespace App\Http\Controllers\TravelExpress;

use App\Model\Car;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->indexUser(Auth::user());
    }

    public function indexUser(User $user) {
        $car = $user->getCar();
        return View('pages.cars.index', compact('user', 'car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        $car = $user->getCar();
        return View('pages.cars.edit', compact('user', 'car'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Check if the user already have a car
        if (Car::where('user_id', Auth::user()->id)->first() !== null) {
            return redirect('/cars');
        }
        return View('pages.cars.create');
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

        // Check if the user already have a car
        if (Car::where('user_id', Auth::user()->id)->first() !== null) {
            return redirect('/cars');
        }

        $car = new Car();
        $car->user_id = Auth::user()->id;
        $car->fill($request->only(['model', 'make', 'nb_seats']));
        $car->save();

        $request->session()->flash('status_success', Lang::get('messages.flash_car_created'));

        return redirect('/cars');
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

        $car = Car::where('user_id', Auth::user()->id)->findOrFail($id)->fill($request->only(['model', 'make', 'nb_seats']))->save();

        $request->session()->flash('status_success', Lang::get('messages.flash_car_updated'));

        return redirect('/cars');
    }

    /**
     * Check the validity of the parameters given in the request
     *
     * @param  \Illuminate\Http\Request  $request
     */
    private function check(Request $request) {
        $this->validate($request, [
                'model' => 'required|min:2|max:150',
                'make' => 'required|min:2|max:150',
                'nb_seats' => 'required|integer|min:2|max:10',
            ]);
    }

}