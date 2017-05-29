<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryFilter;
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
        $filter = new Filter();
        $filter->fill($request->all())->save();

        $categories = collect();
        if (!empty($request['categories'])) {
            foreach ($request['categories'] as $category_id) {
                $categories->push(new CategoryFilter([
                    'category_id' => $category_id
                ]));
            }
            $filter->categories()->saveMany($categories);
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param $category
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function show($category)
    {

        $filters = $category->filters()->get();
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
