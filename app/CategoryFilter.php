<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryFilter extends Model
{
    protected $fillable = ['category_id'];
    public $timestamps = false;
}
