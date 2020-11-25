<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'property_rent_id',
        'property_sale_id',
        'features',
        'created_at',
       'updated_at'
    ];

    public function propertyRent (){
        return $this->belongsMany('App\Models\PropertyRent');
    }
    public function propertySale (){
        return $this->belongsMany('App\Models\PropertySale');
    }
}
