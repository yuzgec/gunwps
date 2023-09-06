<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wishlist extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];
    protected $table = 'wishlist';


    public function getProduct(){
        return $this->hasMany(WishlistProduct::class, 'wishlist_id', 'id');
    }

    public function getOffer(){
        return $this->hasMany(WishlistOffer::class, 'wishlist_id', 'id');
    }

    public function getOfferProduct(){
        return $this->hasMany(WishlistOfferProduct::class,'wishlist_id', 'id');
    }
}
