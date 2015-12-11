<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    //
	protected $table = 'places';
    public static function createPlace($place_name,$place_address,$lat,$lng){
        $check = Place::where('name', $place_name)->first();
        if($check){
            return $check['attributes']['place_id'];
        }else{
            $place = new Place();
            $place->name = $place_name;
            $place->address = $place_address;
            $place->lat = $lat;
            $place->lng = $lng;
            $place->save();
            return $place['attributes']['id'];
        }
    }
    public static function getPlaceById($place_id)
    {
        return Place::where('place_id',$place_id)->first();
    }

}
