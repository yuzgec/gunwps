<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class FaqTranslation extends Model
{
    use HasFactory,LogsActivity;

    public $timestamps = false;
    protected $guarded = [];

    protected $translationForeignKey = 'faq_id';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['title', 'desc']);
    }
}
