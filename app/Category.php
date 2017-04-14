<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $translations;

    public function translation() {
        return $this->hasMany(CategoryTranslations::class);
    }
}
