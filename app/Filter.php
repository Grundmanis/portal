<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use Translatable;

    public $translatedAttributes = ['name','value'];
    protected $fillable = ['category_id','category_parent_id','type','in_filters','in_all_categories', 'in_adverts_list'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function parentCategory() {
        return $this->belongsTo(Category::class,'category_parent_id');
    }
}
