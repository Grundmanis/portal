<?php

namespace App\Http\Controllers;

use App\Advert;
use App\AdvertFilter;
use App\Category;
use App\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereTranslation('locale', App::getLocale())->with('parents')->get();
        return view('advert.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $filter = new AdvertFilter();
        $filter->value = 'test';

        dd($filter);

        $advert = new Advert();
        $advert->fill($data);
        $advert->user_id = Auth::user()->id;
        $advert->save();

        unset($data['_token']);
        unset($data['category_id']);
        unset($data['category_parent_id']);

        // Save advert filters
        $filters = [];
        foreach ($data as $id => $value) {
            $filters[] = [
                'advert_id' => $advert->id,
                'filter_id' => $id,
                'value' => 'test'
            ];
        }

        AdvertFilter::insert($filters);
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
