<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class AdvertFilter extends Model
{
    use Translatable;

    public $translatedAttributes = ['value'];

    protected $fillable = ['advert_id','filter_id'];

    const IMAGE_ID = 1;
    const TEXT_ID = 2;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
     protected $with = ['translations'];

    public function filter()
    {
        return $this->belongsTo(Filter::class);
    }

}
