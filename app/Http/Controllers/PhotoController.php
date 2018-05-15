<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{

    public function __construct(){

        $this->middleware('auth');

    }

    public function store(Request $request){


        $this->validate($request,[
            'photoName' =>'required|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);


        $photo = $request->photo;
        $photo_new_name = time().$photo->getClientOriginalName();
        $photo->move("images",$photo_new_name);

        Photo::create(['name'=>$request->photoName,"album_id"=>$request->albumId,"photo"=>$photo_new_name]);
        return $request->albumId;
    }


    public function destroy(Request $request)
    {
       $album_id = $request->albumId;
        $id = $request->id;
        $photo = Photo::find($id);
        $photo->delete();
        //deleting old image from storage after deleting the post
        unlink('images/' . $photo->photo);

        return $album_id;

    }




}
