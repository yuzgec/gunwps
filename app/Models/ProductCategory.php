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

use Kalnoy\Nestedset\NodeTrait;


class ProductCategory extends Model implements HasMedia,TranslatableContract,Viewable
{
    use HasFactory,SoftDeletes,InteractsWithMedia,NodeTrait,Translatable,InteractsWithViews;

    public $translatedAttributes = ['title','slug', 'short','desc','seo1', 'seo2', 'seo3'];

    protected $guarded = [];
    protected $table = 'product_category';

    public function getProduct(){
        return $this->hasMany(ProdoctCategoryPivot::class,'id', 'category_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('img')->width(1000)->nonOptimized();
        $this->addMediaConversion('thumb')->width(500)->nonOptimized();
        $this->addMediaConversion('small')->width(150)->nonOptimized();
    }

}
