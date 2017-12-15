<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request,[
           'image'=>'sometimes|image'
        ]);
        if ($request->image)
        {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $location = storage_path('images/'.$name);


            Image::make($image)->resize(400,800)->save($location);

            $image_name = new \App\Image;
            $image_name->name=$name;
            $image_name->save();

        } else {
            dd('No Images To Upload');
        }

        return redirect()->route('showImage',$image_name->id);
    }

    public function edit ($id)
    {
        return view('edit')->withId($id);
    }

    public function update (Request $request,$id)
    {
        $this->validate($request,[
            'image'=>'required|image'
        ]);

        //add new image to the storage folder
        $image = $request->file('image');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $location = storage_path('images/'.$name);
        Image::make($image)->resize(400,800)->save($location);

        //get old image name in database
        $image_old = \App\Image::find($id);
        $oldImageName=$image_old->name;

        $image_old->name=$name;
        $image_old->update();

        Storage::disk('image')->delete($oldImageName);

        return redirect()->route('showImage',$image_old->id);
    }

    public function show($id)
    {
        $image = \App\Image::find($id);
        return view('show')->withImage($image);
    }



    public function get ($image)
    {
        $image_get = Storage::disk('image')->get($image);
        return new Response($image_get,200);
    }



}
