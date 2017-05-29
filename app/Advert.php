<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Advert extends Model
{
    protected $fillable = ['category_parent_id','category_id','user_id','text'];

    public function filters() {
        return $this->hasMany(AdvertFilter::class);
    }

    public function getThumb() {
        foreach ($this->images as $image) {
            if ($image->thumb) {
                return Storage::url($image->url);
            }
        }
        return url('images/no-image.svg');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function categories() {
        return $this->hasMany(Category::class);
    }

}
