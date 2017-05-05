<?php

namespace App\Http\Controllers;

use App\Category;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = Category::find(5);
        dd($cat->parents);
        $categories = Category::all();
        return view('home',compact('categories'));
    }
}
