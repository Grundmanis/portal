<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $fillable = ['category_parent_id','category_id','user_id'];

    public function filters() {
        return $this->hasMany(AdvertFilter::class);
    }

}
