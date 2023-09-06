<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistOfferProduct extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'wishlist_offer_products';

    public $timestamps = false;

    public function getWishlist()
    {
        return $this->hasOne(Wishlist::class, 'id', 'wishlist_id');
    }
}
