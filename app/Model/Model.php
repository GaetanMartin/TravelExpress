<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;
use DB;


class Model extends Eloquent
{

     protected $guarded = [];

     /**
      * Return all the possibles values of a column type enum
      * https://stackoverflow.com/questions/26991502/get-enum-options-in-laravels-eloquent
      */
     public static function getPossibleEnumValues($name){
         $instance = new static; // create an instance of the model to be able to get the table name
         $type = DB::select( DB::raw('SHOW COLUMNS FROM '.$instance->getTable().' WHERE Field = "'.$name.'"') )[0]->Type;
         preg_match('/^enum\((.*)\)$/', $type, $matches);
         $enum = array();
         foreach(explode(',', $matches[1]) as $value){
             $v = trim( $value, "'" );
             $enum[] = $v;
         }
         return $enum;
     }
}
