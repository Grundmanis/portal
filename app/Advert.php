<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $fillable = ['category_parent_id','category_id','user_id'];

    public function filters() {
        return $this->hasMany(AdvertFilter::class);
    }

    public function getImage() {
        foreach ($this->filters as $filter) {
            if ($filter->filter_id == AdvertFilter::IMAGE_ID) {
                return $filter->value;
            }
        }
    }

    public function getText() {
        foreach ($this->filters as $filter) {
            if ($filter->filter_id == AdvertFilter::TEXT_ID) {
                return $filter->value;
            }
        }
    }

}
