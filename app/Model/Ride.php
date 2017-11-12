<?php

namespace App\Model;


use DB;

/**
 * Ride
 */
class Ride extends Model
{

    /**
     * Table Name
     * @var string
     */
    protected $table = 'rides';

    protected $dates = ['start_time'];

    /**
     * Find a ride with every information needed
     * @param $id id of the ride required
     */
    public static function findWithDetail($id) {
    	return Ride::select('start_time', 'price', 'source_city.city as source_city', 
            'dest_city.city as dest_city', 'preferences.*', 'rides.nb_seats_offered', 
            'rides.luggage_size', 'rides.id', 'rides.car_id')
            ->join('cities as source_city', 'rides.source_city_id', 'source_city.id')
            ->join('cities as dest_city', 'rides.dest_city_id', 'dest_city.id')
            ->join('cars', 'rides.car_id', 'cars.id')
            ->join('users', 'cars.user_id', 'users.id')
            ->join('preferences', 'preferences.user_id', 'users.id')
            ->findOrFail($id);
    }

    /**
     * Find a ride with every information needed
     * @param $id id of the ride required
     */
    public static function getNbSeatsAvailable($id) {

        // Nb seats offered
        $nbSeatsOffered = Ride::select('rides.nb_seats_offered')->findOrFail($id)->nb_seats_offered;

        // Nb seats already booked
        $nbSeatsBooked = Booking::where('bookings.ride_id', $id)
            ->where('bookings.status', 'messages.confirmed')
            ->sum('bookings.nb_seats_booked');

        return $nbSeatsOffered - $nbSeatsBooked;
    }

    public static function getDetailQuery() {
        return Ride::select('start_time', 'price', 'source_city.city as source_city', 
            'dest_city.city as dest_city', 'preferences.*', 'rides.nb_seats_offered', 
            'rides.luggage_size', 'rides.id')
            ->join('cities as source_city', 'rides.source_city_id', 'source_city.id')
            ->join('cities as dest_city', 'rides.dest_city_id', 'dest_city.id')
            ->join('cars', 'rides.car_id', 'cars.id')
            ->join('users', 'cars.user_id', 'users.id')
            ->join('preferences', 'preferences.user_id', 'users.id')
            ->orderBy('rides.created_at', 'desc');
    }
}
