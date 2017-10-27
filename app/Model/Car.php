<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string model
 * @property string make
 * @property int nb_seats
 */
class Car extends Model
{

    /**
     * Table Name
     * @var string
     */
    protected $table = 'cars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model',
        'make',
        'nb_seats',
    ];
}
