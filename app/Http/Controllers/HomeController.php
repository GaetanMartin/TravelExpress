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
        // Select last 1000 rides
        $rides = Ride::select('start_time', 'price')->orderBy('created_at', 'desc')->take(1000)->get();
        return view('pages.home', compact('rides'));
    }
    public function contact()
    {
        return view('pages.contact');
    }
}
