<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detection extends Model
{
    protected $guarded = [
        'id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function image() {
        return $this->hasOne(DetectionImage::class, 'detection_id', 'id');
    }
}
