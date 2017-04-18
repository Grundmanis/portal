<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $with = ['translation','subcategories','filters'];

    public function translation() {
        return $this->hasOne(CategoryTranslations::class)->where('lng','en');
    }

    public function subcategories() {
        return $this->belongsToMany(Subcategory::class);
    }
    
    public function filters() {
        return $this->hasMany(CategoryFilter::class);
    }

}
