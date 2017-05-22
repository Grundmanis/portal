<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use Translatable;

    public $translatedAttributes = ['name','value'];
    protected $fillable = ['category_id','category_parent_id','type','in_adverts_list','in_filters','in_all_categories','key'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function parentCategory() {
        return $this->belongsTo(Category::class,'category_parent_id');
    }

    public function setInAdvertsListAttribute() {
        $this->attributes['in_adverts_list'] = 1;
    }

    public function setInFiltersAttribute() {
        $this->attributes['in_filters'] = 1;
    }

    public function setInAllCategoriesAttribute() {
        $this->attributes['in_all_categories'] = 1;
    }
}
