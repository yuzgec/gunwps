<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistProduct extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'wishlist_product';

    public $timestamps = false;





}
