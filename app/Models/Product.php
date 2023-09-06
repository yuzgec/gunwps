<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements TranslatableContract,HasMedia,Viewable
{
    use HasFactory,SoftDeletes,InteractsWithMedia,Translatable,InteractsWithViews;

    public $translatedAttributes = ['title', 'slug','short','desc','note','seo1', 'seo2', 'seo3'];

    protected $guarded = [];
    protected $table = 'products';

    public function getCategory(){
        return $this->hasMany(ProdoctCategoryPivot::class, 'product_id', 'id');
    }


    public function getBrand(){
        return $this->hasone(Brand::class, 'id', 'brand');
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('img')->width(1000)->nonOptimized();
        $this->addMediaConversion('thumb')->width(500)->nonOptimized();
        $this->addMediaConversion('small')->width(150)->nonOptimized();
        $this->addMediaConversion('icon')->width(50)->nonOptimized();
    }
}
