<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Ride;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rides = Ride::select('start_time', 'price')->get();
        return view('pages.home', compact('rides'));
    }
    public function contact()
    {
        return view('pages.contact');
    }
}
