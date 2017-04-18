<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertFilter extends Model
{
    protected $with = ['values'];
    public function values() {
        return $this->belongsTo(CategoryFilter::class,'filter_id');
    }
}
