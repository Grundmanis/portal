<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Advert extends Model
{
    protected $fillable = ['category_parent_id','category_id','user_id'];

    public function filters() {
        return $this->hasMany(AdvertFilter::class);
    }

    public function getFirstImage() {
        foreach ($this->filters as $filter) {
            if ($filter->filter_id == AdvertFilter::IMAGE_ID) {
                $images = json_decode($filter->value);
                return Storage::url($images[0]);
            }
        }
        return null;
    }

    public function getImages() {
        foreach ($this->filters as $filter) {
            if ($filter->filter_id == AdvertFilter::IMAGE_ID) {
                return json_decode($filter->value);
            }
        }
        return null;
    }

    public function getText() {
        foreach ($this->filters as $filter) {
            if ($filter->filter_id == AdvertFilter::TEXT_ID) {
                return $filter->value;
            }
        }
        return null;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
