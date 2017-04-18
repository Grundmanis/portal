<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $with = ['translation'];

    public function translation() {
        return $this->hasOne(CategoryTranslations::class)->where('lng','en');
    }
}
