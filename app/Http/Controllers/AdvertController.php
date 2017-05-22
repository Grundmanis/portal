<?php

namespace App\Http\Controllers;

use App\Advert;
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

        // Save images
        $date = strtotime(date('Y-m-d',time()));
        $folder = config('filesystems.uploads_folder') . $date . '/' . $advert->id . '/';

        if (!empty($data['images'])) {
            foreach ($data['images'] as $k => $file) {

                // create folder
                if (!File::exists($folder))
                {
                    Storage::makeDirectory('public/' . $folder);
                }

                $fileName = md5(uniqid()) . '.' . $file->getClientOriginalExtension();
                $path = $folder . $fileName;

                $image = Image::make($file->getRealPath());
                $image->resize(null, 800, function ($constraint) {
                    $constraint->aspectRatio();
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
        }

        $advert->images()->saveMany($images);
        
        return redirect('/');
    }

    public function store_bak (Request $request)
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

            if ($id == 'images') {
                $id = AdvertFilter::IMAGE_ID;
                $images = [];
                foreach ($value as $v) {
                    $fileName = $v->getClientOriginalName();
                    $path = 'uploads/images/' . $folder . '/' . $advert->id . '/';
                    $v->move($path, $fileName);

                    $image = Image::make($path.$fileName);
                    $image->resize(100,80);

                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }

                    $v = $path . 'thumb_'.$fileName;
                    $image->save($v);
                    $images[] = $v;
                }
                $value = json_encode($images);
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
