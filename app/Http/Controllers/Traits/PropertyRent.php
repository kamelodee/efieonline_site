<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Brackets\Media\HasMedia\ProcessMediaTrait;
use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations ;
class PropertyRent extends Model  implements HasMedia{

    use ProcessMediaTrait;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    
   
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'user_id',
        'location_id',
        'title',
        'description',
        'slug',
        'property_type',
        'property_status',
        'property_label',
        'monthly_rate',
        'yearly_rate',
        'rent_duration',
        'currency',
        'water',
        'is_featured',
        'is_appropved',
        'is_published',
        'features',
        'created_at',
       'updated_at'
    ];
   

  

  
    protected $table = "property_rents";
  
   

    public function agent (){
        return $this->belongsTo('App\Models\Agent');
    }
    public function location(){
        return $this->belongsTo('App\Models\Location');
    }
    public function property_has_category(){
        return $this->belongsTo('App\Models\Property_has_category');
    }
    public function feature(){
        return $this->hasMany('App\Models\Feature');
    }

    public function detail(){
        return $this->hasOne('App\Models\PropertyDetail');
    }
    public function registerMediaConversions(Media $media = null):void
    {

       

        $this->addMediaConversion('large')
            ->width(1024)
            ->watermark(public_path('assets/img/efieonline.png'))
            ->watermarkOpacity(50)
            ->sharpen(10)
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->performOnCollections('images','gallery')
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(1024)
            ->watermark(public_path('assets/img/efieonline.png'))
            ->watermarkOpacity(50)
            ->sharpen(10)
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->performOnCollections('images','main_photo')
            ->nonQueued();

    }
   

  

    public function getMainPhotoAttribute()
    {
        // $file = $this->getMedia('main_photo')->last();

        // // if ($file) {
        // //     $file->url       = $file->file_name();
        // //     $file->thumbnail = $file->getUrl('thumb');
        // // }

        // return $file;
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
