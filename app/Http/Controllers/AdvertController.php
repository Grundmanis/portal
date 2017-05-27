<?php

namespace App\Http\Controllers;

use App\Advert;
use App\AdvertCategory;
use App\AdvertFilter;
use App\Category;
use App\Http\Requests\MessageRequest;
use App\Mail\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
        // Save advert
        $data = $request->all();

        $advert = new Advert();
        $advert->user_id = Auth::user()->id;
        $advert->fill($data)->save();

        // Save categories
        $categories = collect();
        foreach ($data['categories'] as $category) {
            $categories->push(new AdvertCategory([
                'category_id' => $category,
            ]));
        }

        $advert->categories()->saveMany($categories);
        // Save advert filters
        $filters = $images = collect();
        if (!empty($data['filters'])) {
            foreach ($data['filters'] as $filter_id => $filter) {
                if (!$filter) continue;
                $filters->push(new AdvertFilter([
                    'advert_id' => $advert->id,
                    'filter_id' => $filter_id,
                    'value' => $filter
                ]));
            }
            $advert->filters()->saveMany($filters);
        }

        if (!empty($data['images'])) {
            // Save images
            $date = strtotime(date('Y-m-d',time()));
            $folder = config('filesystems.uploads_folder') . $date . '/' . $advert->id . '/';

            foreach ($data['images'] as $k => $file) {

                // create folder
                if (!File::exists($folder))
                {
                    Storage::makeDirectory('public/' . $folder);
                }

                $fileName = md5(uniqid()) . '.' . $file->getClientOriginalExtension();
                $path = $folder . $fileName;

                $image = Image::make($file->getRealPath());
                $image->resize(800, 800, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image->save('storage/' . $folder . $fileName);
                $images->push(new \App\Image([
                    'advert_id' => $advert->id,
                    'url' => $path
                ]));

                // thumb
                if (!$k) {
                    $fileName = md5(uniqid()) . '.' . $file->getClientOriginalExtension();

                    $thumb = clone $image;
                    $thumb->resize(100, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $thumb->crop(100, 70, 0, 0);

                    $thumb->save('storage/' . $folder . $fileName);

                    $images->push(new \App\Image([
                        'advert_id' => $advert->id,
                        'url' => $folder . $fileName,
                        'thumb' => 1
                    ]));
                }
            }

            $advert->images()->saveMany($images);
        }
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function show($advert)
    {
        return view('advert.show',[
            'advert' => $advert->load('filters.filter')
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
     * @param  Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function destroy($advert)
    {
        $advert->delete();
        return back();
    }

    public function message(Advert $advert, MessageRequest $request) {
        $receiverMail = $advert->user->email;
        Mail::to($receiverMail)->send(new SendMessage($advert, $request));

        if (Mail::failures()) {
            $request->session()->flash('success_message', 'Something was wrong, try again.');
        } else {
            $request->session()->flash('success_message', 'Message was sent!');
        }

        return back();

    }
}
