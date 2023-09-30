<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedIncludeProduct extends Model
{
    use HasFactory;
    protected $table ='related_include_products';
    protected $guarded = [];
    public $timestamps = false;
}
