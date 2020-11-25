<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property_has_category extends Model
{
    //
    protected $table = "property_has_categories";
    public function propertySale(){
        return $this->hasMany('App\Models\PropertySale');
    }
    public function property_rent(){
        return $this->hasMany('App\Models\Property_rent');
    }
    public function category(){
        return $this->hasMany('App\Models\Category');
    }
}
