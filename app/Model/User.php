<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getName() {
        return $this->first_name . " " . $this->last_name;
    }

    public function getPreference() {
        return Preference::where('user_id', $this->id)->firstOrFail();
    }

    public function getCar() {
        return Car::where('user_id', $this->id)->first();
    }
}
