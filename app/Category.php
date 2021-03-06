<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    public $translatedAttributes = ['name'];
    protected $with = ['child'];
    protected $fillable = ['slug','secondary'];

    public function parents()
    {
        return $this->belongsToMany(Category::class,'category_relations','category_id','parent_id');
    }

    public function child()
    {
        return $this->belongsToMany(Category::class,'category_relations','parent_id','category_id');
    }

    public function filters() {
        return $this->belongsToMany(Filter::class, 'category_filters');
    }

    public function adverts() {
        return $this->belongsToMany(Advert::class,'advert_categories');
    }

}
