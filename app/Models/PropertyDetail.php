<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyDetail extends Model
{
    //

    protected $fillable = [
        'property_rent_id',
        'property_sale_id',
        'nature_of_building',
        'bedrooms',
        'bathrooms',
        'year_build',
        'car_packing',
        'security',
        'electricity',
        'waste_disposal',
        'toilet',
        'landlord_residential_status',
        'kitchen',
        'compound_cleaning',
        'water',
        'kitchen_type',
        'bathroom_type',
        'special_condition',
       'reason',
       'bathroom_type',
       'created_at',
       'updated_at',
    ];
    public function propertyRent (){
        return $this->belongsMany('App\Models\PropertyRent');
    }
    public function propertySale (){
        return $this->belongsMany('App\Models\PropertySale');
    }
}
