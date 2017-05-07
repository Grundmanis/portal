<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class AdvertFilter extends Model
{
    use Translatable;
    public $translatedAttributes = ['value'];
    protected $fillable = ['advert_id','filter_id'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
     protected $with = ['translations'];


}
