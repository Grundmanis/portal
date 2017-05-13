<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Category;
use App\CategoryRelation;
use App\Service\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $service = new CategoryService($request);

        if ($service->categoryChild->isEmpty()) {
            $service->getAdverts()
                ->getCategoryFilters();
        }
        
        return view($service->getViewName(),$service->getViewData());
    }

    public function categories() {
        $categories = Category::with('parents', 'translations', 'child.translations')->get();
        return view('home',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // TODO
        // save translations
        $data = [
            'slug' => $request->slug,
            'en' => ['name' => $request->name['en']],
            'lv' => ['name' => $request->name['lv']],
            'ru' => ['name' => $request->name['ru']],
        ];
        $category = Category::create($data);

        // save relations
        $category_relations = [];
        if ($request->parent_id) {
            foreach ($request->parent_id as $id) {
                $category_relations[] = ['category_id' => $category->id, 'parent_id' => $id];
            }
        }
        CategoryRelation::insert($category_relations);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
