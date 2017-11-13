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


    public static function getPendingBookings($user_id, $id_booking) {
    	return Booking::select('bookings.*')
            ->where('status', 'messages.pending')
            ->join('rides', 'bookings.ride_id', 'rides.id')
    		->join('cars', 'rides.car_id', 'cars.id')
    		->join('users', 'cars.user_id', 'users.id')
            ->where('users.id', $user_id)
    		->whereDate('rides.start_time', '>=', Carbon::today()->toDateString())
    		->find($id_booking);
    }

    public static function getQueryPendingToBeAccepted($user_id) {
        return Booking::select('bookings.*')
            ->join('rides', 'rides.id', 'ride_id')
            ->join('cars', 'rides.car_id', 'cars.id')
            ->join('users', 'cars.user_id', 'users.id')
            ->where('users.id', $user_id)
            ->where('bookings.status', 'messages.pending')
            ->whereDate('rides.start_time', '>=', Carbon::today()->toDateString());
    }

    public static function getQueryPendingToBePaid($user_id) {
        return Booking::select('bookings.*')
            ->join('rides', 'rides.id', 'ride_id')
            ->join('cars', 'rides.car_id', 'cars.id')
            ->join('users', 'cars.user_id', 'users.id')
            ->where('requester_id', $user_id)
            ->where('bookings.status', 'messages.accepted')
            ->whereDate('rides.start_time', '>=', Carbon::today()->toDateString());
    }
}
