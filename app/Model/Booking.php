<?php

namespace App\Model;

use Carbon\Carbon;

/**
 * Booking
 */
class Booking extends Model
{

    /**
     * Table Name
     * @var string
     */
    protected $table = 'bookings';

    protected $fillable = ['username','password'];


    public static function getPendingBookings($car_id) {
    	return Booking::select('*', 'bookings.id')->where('status', 'messages.pending')
    		->join('rides', 'bookings.ride_id', 'rides.id')
    		->where('rides.car_id', $car_id)
    		->whereDate('rides.start_time', '>=', Carbon::today()->toDateString())
    		->get();
    }

    public static function getVerifyingCar($id, $car_id) {
        return Booking::select('*', 'bookings.id')->where('status', 'messages.pending')
            ->join('rides', 'bookings.ride_id', 'rides.id')
            ->where('rides.car_id', $car_id)
            ->where('bookings.id', $id)
            ->findOrFail($id);
    }
}
