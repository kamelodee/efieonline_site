<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $table = "locations";
    
    protected $fillable = [
        'name',
        'address',
        'city',
        'region',
        'country',
        'longitute',
        'latitude',
        'created_at',
       'updated_at'
    ];
   

    public function propertySale(){
        return $this->hasMany('App\Models\PropertySale');
    }
    public function propertyRent(){
        return $this->hasMany('App\Models\PropertyRent');
    }
}
