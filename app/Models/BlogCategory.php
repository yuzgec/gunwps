<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BlogCategory extends Model implements HasMedia,TranslatableContract
{
    use HasFactory, SoftDeletes, InteractsWithMedia, NodeTrait, Translatable;

    public $translatedAttributes = ['title', 'slug', 'short', 'desc', 'seo1', 'seo2', 'seo3'];

    protected $guarded = [];
    protected $table = 'blog_category';


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('img')->width(1000)->nonOptimized();
        $this->addMediaConversion('thumb')->width(500)->nonOptimized();
        $this->addMediaConversion('small')->width(150)->nonOptimized();
    }
}
