<?php

namespace App\Model;

class Preference extends Model
{

    /**
     * Table Name
     * @var string
     */
    protected $table = 'preferences';

    // protected $guarded = ['user_id'];

    function __construct($smoker_accepted, $pet_accepted, $radio_accepted, $chat_accepted) {
    	$this->smoker_accepted = $smoker_accepted;
    	$this->pet_accepted = $pet_accepted;
    	$this->radio_accepted = $radio_accepted;
    	$this->chat_accepted = $chat_accepted;
    }
}
