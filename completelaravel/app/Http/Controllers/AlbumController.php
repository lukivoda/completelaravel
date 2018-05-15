<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller{

    public function __construct(){

    $this->middleware('auth');

    }

    public function index(){

        $albums  = Album::all();

        return view("admin.albums.index",compact('albums'));
 }


 public function store(Request $request) {

     $this->validate($request,[
         'albumName' =>'required|max:255',
         'coverImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

     ]);


     $coverImage = $request->coverImage;
     $coverImage_new_name = time().$coverImage->getClientOriginalName();
     $coverImage->move("images",$coverImage_new_name);

     Album::create(['name' => $request->albumName ,'description' => $request->description,'cover_image' => $coverImage_new_name]);


 }


 public function show($id){

        $album = Album::find($id);

        $photos = $album->photos;

        return view("admin.albums.show",compact('album','photos'));
 }


 public function edit($id){

        $album = Album::find($id);

        return $album;
 }


 public function update(Request $request) {



     $this->validate($request,[
         'albumName' =>'required|max:255'
     ]);

     $id = $request->id;
     $album=  Album::find($id);


     $album->name= $request->albumName;
     $album->description = $request->albumDescription;


     $extensions =  ['jpeg','png','jpg','gif','svg'];

     if($request->coverImage !== "undefined") {
         $coverImage = $request->coverImage;
         $coverImageExtension = $coverImage->getClientOriginalExtension();
         $coverImageSize = $coverImage->getClientSize();
         if(in_array($coverImageExtension,$extensions) && $coverImageSize < 2097152) {
             $old_image_name = $album->cover_image;
             $coverImage_new_name = time() . $coverImage->getClientOriginalName();
             $coverImage->move("images", $coverImage_new_name);
             $album->cover_image= $coverImage_new_name;

             $album->save();
             //deleting old image from storage after inserting new one
             unlink('images/' .  $old_image_name);



         } else {

             return response( [
                 'errors' => ['Only images that are not bigger than 2mb are allowed  !']
             ],422);
         }
     }



     $album->save();
     }


    public function destroy(Request $request)
    {

        $id = $request->id;
        $album = Album::find($id);



        //deleting old image from storage after deleting the post
        foreach ($album->photos as $photo) {
            unlink('images/' . $photo->photo);
        }

        $album->delete();
        unlink('images/' . $album->cover_image);

    }

}
