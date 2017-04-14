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
        $categories = Category::all();
        return view('home',[
            'categories' => json_encode($categories)
        ]);
    }
}
