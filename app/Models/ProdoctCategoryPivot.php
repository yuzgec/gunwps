<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProdoctCategoryPivot extends Pivot
{
    use HasFactory;
    protected $table = "category_product";
    protected $guarded = [];

    public function categoryFind(){
        return $this->hasOne(ProductCategory::class, 'category_id', 'id');
    }

    public $timestamps = false;

}
