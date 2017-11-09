<?php

namespace App\Model;

/**
 * @property int user
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

    protected $guarded = ['user_id'];

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
