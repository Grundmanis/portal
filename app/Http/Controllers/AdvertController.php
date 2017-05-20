<?php

namespace App\Http\Controllers;

use App\Advert;
use App\AdvertFilter;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

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

        $advert = new Advert();
        $advert->fill($data);
        $advert->user_id = Auth::user()->id;
        $advert->save();

        $unix = strtotime($advert->created_at);
        $date = date('Y-m-d',$unix);
        $folder = strtotime($date);

        unset($data['_token']);
        unset($data['category_id']);
        unset($data['category_parent_id']);

        // Save advert filters
        $filters = [];
        foreach ($data as $id => $value) {

            if (!$value) continue;

            if ($id == AdvertFilter::IMAGE_ID) {
                $fileName = $value->getClientOriginalName();
                $path = 'uploads/images/' . $folder . '/' . $advert->id . '/';
                $value->move($path, $fileName);

                $image = Image::make($path.$fileName);
                $image->resize(100,80);

                if(!File::exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                }

                $value = $path . 'thumb_'.$fileName;
                $image->save($value);
            }

            $filters[] = new AdvertFilter([
                'advert_id' => $advert->id,
                'filter_id' => $id,
                'value' => $value
            ]);
        }

        $advert->filters()->saveMany($filters);

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
     * @param  Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advert $advert)
    {
        $advert->delete();
        return back();
    }
}
