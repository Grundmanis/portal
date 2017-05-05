<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Category;
use App\Http\Requests\AdvertsListRequest;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdvertController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param AdvertsListRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(AdvertsListRequest $request) {

        $first = true;
        $adverts = Advert::where('category_id',$request->category->id)
            ->where('subcategory_id', $request->subcategory->id)
            ->whereHas('filters', function($query) {
                $query->whereIn('value',['week','jurmala']);
                $query->whereIn('key',['work_days','location']);
            })
            ->with('filters')
//            ->toSql();
            ->paginate($request->per_page ? $request->per_page : 2);

//        dd($adverts);

        // set ID es key for JS objects
        foreach ($adverts as $k => $advert) {
            $advert->idFilters = $advert->filters->keyBy('filter_id');
            $adverts[$k] = $advert;
        }

        if ($request->ajax()) {
            return response()->json([
                'adverts' => $adverts
            ]);
        }

        return view('adverts/index', [
            'adverts' => $adverts,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->keyBy('id');
        return view('adverts/create', compact('categories'));
    }


    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) {
        return view('adverts/show', [
            'advert' => $request->advert,
            'advertFilters' => $request->advert->filters->keyBy('id'),
            'category' => $request->category,
            'subcategory' => $request->subcategory,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $advert = new Advert($request->all());
        $advert->user_id = Auth::user()->id;
        $advert->save();

        // TODO 
        $category = Category::find($request->category_id);
        $subcategory = Subcategory::find($request->subcategory_id);

        return response()->json([
            'message' => 'New advert is created',
            'advert' => $advert,
            'redirect' => route('adverts.show',[$category->slug,$subcategory->slug, $advert->id])
        ]);
    }
    
}
