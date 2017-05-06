<?php

namespace App\Http\Controllers;

use App\Category;
use App\Filter;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = Filter::all();
        return view('filter.index',compact('filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('filter.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // save translations
        $data = [
            'category_parent_id' => $request->category_parent_id,
            'category_id' => $request->category_id,
            'type' => $request->type,
            'key' => $request->key,
            'in_filters' => $request->in_filters == 'on' ? 1 : 0,
            'all_categories' => $request->all_categories == 'on' ? 1 : 0,
            'en' => ['name' => $request->name['en'],'value' => $request->value['en']],
            'lv' => ['name' => $request->name['lv'],'value' => $request->value['lv']],
            'ru' => ['name' => $request->name['ru'],'value' => $request->value['ru']],
        ];

        Filter::create($data);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $category = $request->subcategory; // 3 vacancies
        $parent_category = $request->category; // 1 work
        $filters = Filter::where('category_id',$category->id)->where('category_parent_id',$parent_category->id)->orWhere('all_categories',1)->get();

        return response()->json([
            'filters' => $filters->chunk(ceil(count($filters) / 2))
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
