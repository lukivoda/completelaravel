<?php

namespace App\Http\Controllers;

use App\Album;
use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class FrontendController extends Controller
{
   public  function index(Request $request) {

    $posts = Post::orderBy('created_at','desc')->paginate(4);

      $user = User::find(1);
      $name = $user->name;

      $latest_posts = Post::orderBy('created_at','desc')->take(3)->get();

      $categories = Category::all();


      $tags = Tag::all();
       return view('index',compact('posts','name','latest_posts','categories','tags'));
   }


   public function categoryPosts(Request $request) {

       $category = Category::find($request->category_id);
       $posts = $category->posts()->orderBy('created_at','desc')->paginate(4);

       return response()->json($posts);

   }



   public function show($slug) {

       $post =  Post::whereSlug($slug)->first();
      // return $post;

       $latest_posts = Post::orderBy('created_at','desc')->take(3)->get();

       $categories = Category::all();


       $tags = Tag::all();

       $post_tags = $post->tags;

       return view("single",compact("post","post_tags","latest_posts","categories","tags"));
   }

   public function autocomplete(Request $request) {

       $term = $request->term;

       $posts = Post::where('title', 'LIKE', '%'.$term.'%')->get();

       $data  = [];

       foreach($posts as $key =>$value) {
           $data[] = [
             'id' => $value->id,
             'label' => $value->title,
             'slug' => $value->slug
           ];
       }

       return response($data);


  }


   public function search(Request $request) {

       $this->validate($request,[
           "searchTerm" => "required"
       ]);

     $searchTerm =  $request->searchTerm;

//     $posts = Post::where('title','LIKE','%'.$searchTerm.'%')->orWhere('content','LIKE','%'.$searchTerm.'%')->get();

       $posts = Post::where('title','LIKE','%'.$searchTerm.'%')->get();
    $data = [];

    foreach($posts as $post){
        $category_name =  $post->category->name;
        $post['category_name'] = $category_name;
    }

     return $posts;

   }


   public function tagged($tag){

       $tag = Tag::whereName($tag)->first();

       $posts =$tag->posts()->orderBy('created_at','desc')->paginate(4);

       //return $posts;



       $user = User::find(1);
       $name = $user->name;

       $latest_posts = Post::orderBy('created_at','desc')->take(3)->get();

       $categories = Category::all();


       $tags = Tag::all();
       return view('tagged',compact('tag','posts','name','latest_posts','categories','tags'));

   }



   public function albums(){

       $albums  = Album::all();

       $latest_posts = Post::orderBy('created_at','desc')->take(3)->get();
       return view('gallery',compact('latest_posts','albums'));
   }


   public function photosById(Request $request){

       $album = Album::find($request->id);
        $albumName = $album->name;
       $photos = $album->photos;
       foreach($photos as $photo){
           $photo->albumName = $albumName;
       }



       return $photos;

   }





}
