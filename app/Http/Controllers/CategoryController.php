<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryRelation;
use App\Service\CategoryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{

    public function index()
    {

        $categories = Category::with('parents', 'translations', 'child.translations')->get();
        return view('home',compact('categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function categories(Request $request) {

        $category = $request->categories['category'];
        $categoryChild = $category->child;

        if ($categoryChild->isEmpty() || !empty($request->categories['show']) || $request->has('page')) {

            $adverts = $category->adverts();

            // Get ordered by date
            if (!empty($request->categories['show'])) {
                $show = $request->categories['show'];

                // Dynamic days
                $forDays = explode('for_days_', $show);
                if (!empty($forDays[1])) {
                    $whereDate = Carbon::now()->subDays($forDays[1])->toDateString();
                }

                if ($show == 'today') {
                    $whereDate = Carbon::today();
                }

                if (isset($whereDate)) {
                    // Apply query by date
                    $adverts = $adverts->whereDate('adverts.created_at', '>=' , $whereDate);
                }

            }

            $adverts = $adverts->orderBy('id','desc')->with('filters')->paginate(1);
            $filters = $category->filters()->where('in_adverts_list',1);

            return view('advert.index',[
                'adverts' => $adverts,
                'category' => $category,
                'filters' => $filters,
                'user' => Auth::user()
            ]);
        }

        $slug = '';
        foreach ($request->categories['categories'] as $category) {
            $slug .= $category->slug . '/';
        }

        return view('category.index',[
            'categories' => $categoryChild,
            'slug' => $slug
        ]);
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
        dd(2);
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
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @internal param int $id
     */
    public function destroy($category)
    {
        $category->delete();
        return back();
    }
}
