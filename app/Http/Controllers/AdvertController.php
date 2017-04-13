<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvertController extends Controller
{
    public function index() {
        return view('adverts');
    }
}
