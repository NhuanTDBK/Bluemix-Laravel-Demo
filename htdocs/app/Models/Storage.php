<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Storage extends Model
{
    //
    protected $table="storage";
    protected $primaryKey = "object_id";
    public static function getLink($objectName){
        $result = Storage::where('object_name',$objectName)->first();
        return $result["object_link"];
    }
    public static function createLink($objectName,$objectLink){

    }
}
