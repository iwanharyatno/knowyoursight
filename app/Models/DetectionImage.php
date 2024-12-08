<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetectionImage extends Model
{
    protected $guarded = [
        'id'
    ];

    public function detection() {
        return $this->belongsTo(Detection::class, 'detection_id', 'id');
    }
}
