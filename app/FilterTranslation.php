<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilterTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','value'];
}
