<?php

namespace App\Model;

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
}
