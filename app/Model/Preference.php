<?php

namespace App\Model;

class Preference extends Model
{

    /**
     * Table Name
     * @var string
     */
    protected $table = 'preferences';

    protected $guarded = ['user_id'];
}
