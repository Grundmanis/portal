<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    /**
     * @return mixed
     */
    public function index() {
        return view('categories');
    }
}
