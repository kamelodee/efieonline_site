<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;



use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations ;

class PropertySale extends Model implements HasMedia
{
    use InteractsWithMedia;
   

    protected $table = "property_sales";

    protected $fillable = [
        'user_id',
        'location_id',
        'title',
        'description',
        'slug',
        'property_type',
        'property_status',
        'property_label',
        'sale_price',
        'currency',
        'water',
        'is_featured',
        'is_appropved',
        'is_published',
        'features',
        'created_at',
       'updated_at'
    ];

    public function user (){
        return $this->belongsTo('App\Models\User');
    }
    public function location(){
        return $this->belongsTo('App\Models\Location');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function feature(){
        return $this->hasMany('App\Models\Feature');
    }
    public function detail(){
        return $this->hasOne('App\Models\PropertyDetail');
    }
    public function bookApointment(){
        return $this->hasOne('App\Models\BookApointment');
    }


    public function registerMediaConversions(Media $media = null):void
    {

       

        $this->addMediaConversion('large')
            ->width(1024)
            ->watermark(public_path('assets/img/efieonline.png'))
            ->watermarkOpacity(50)
            ->sharpen(10)
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->withResponsiveImages()
            ->performOnCollections('images','gallery')
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(1024)
            ->watermark(public_path('assets/img/efieonline.png'))
            ->watermarkOpacity(50)
            ->sharpen(10)
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->withResponsiveImages()
            ->performOnCollections('images','main_photo')
            ->nonQueued();

    }
   
    //media
    public function getMainPhotoAttribute()
    {
        $file = $this->getMedia('main_photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

    public function getGalleryAttribute()
    {
        $files = $this->getMedia('gallery');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
        });

        return $files;
    }
}
