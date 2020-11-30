<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations ;
class Agent extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    

    protected $fillable = [
        'user_id',
        'roles',
        'first_name',
        'last_name',
        'phone_number',
        'gps_address',
        'address',
        'city',
        'region',
        'country',
        'is_verified',
        'created_at',
       'updated_at'
    ];

// 

public function registerMediaConversions(Media $media = null):void
{

   

    $this->addMediaConversion('large')
        ->width(1024)
        ->watermark(public_path('assets/img/efieonline.png'))
        ->watermarkOpacity(50)
        ->sharpen(10)
        ->watermarkPosition(Manipulations::POSITION_CENTER)
        ->performOnCollections('images','id_card')
        ->nonQueued();


}


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
