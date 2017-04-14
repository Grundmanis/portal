<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $translations;
    protected $with = ['translation'];

    public function translation() {
        return $this->hasOne(CategoryTranslations::class)->where('lng','en');
    }

    public function getTranslationAttribute($value) {
        dd($value);
    }

}
