<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['slug'];
    protected $with = ['child'];

    public function parents()
    {
        return $this->belongsToMany(Category::class,'category_relations','category_id','parent_id');
    }

    public function child()
    {
        return $this->belongsToMany(Category::class,'category_relations','parent_id','category_id');
    }

    public function filters() {
        return $this->hasMany(Filter::class);
    }

}
