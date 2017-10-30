<?php
/**
 * Created by PhpStorm.
 * User: Gaetan
 * Date: 24/10/2017
 * Time: 16:20
 */

namespace App\Http\Controllers\TravelExpress;

use App\Model\Car;
use App\Http\Controllers\Controller;

class CarsController extends Controller
{
    public function store() {

         $car = new Car();
         $car->model = "Aveo";
         $car->make = "Chevrolet";
         $car->nb_seats = 5;
        
         $car->save();


         $this->validate(request(), [
         	'model' => 'required|min:2|max:25',
         ]);



         Car::create(request(['model', 'make', 'nb_seats']));

        // $car = Car::find(2);
        // print_r($car->nb_seats);

        return view('pages.home');
    }

}