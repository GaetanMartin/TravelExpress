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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
                'model' => 'required|min:2|max:150',
                'make' => 'required|min:2|max:150',
                'nb_seats' => 'required|integer|min:2|max:10',
            ]);

        $car = Car::findOrFail($id);
        $car->fill($request->only(['model', 'make', 'nb_seats']));
        $car->user_id = Auth::user()->id;
        $car->save();

        $request->session()->flash('status_success', Lang::get('messages.flash_car_updated'));

        return redirect('/cars');
    }

}