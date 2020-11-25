<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'created_at',
       'updated_at'
    ];
    protected $table = "categories";
    public function propertySale(){
        return $this->hasMany('App\Models\PropertySale');
    }
    public function propertyRent(){
        return $this->hasMany('App\Models\PropertyRent');
    }
}
