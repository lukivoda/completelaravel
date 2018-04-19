<?php

namespace App\Http\Controllers;


use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
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
    public function create(Request $request)
    {
        $posts = Post::orderBy('created_at','desc')->paginate(5);
        $categories = Category::all();
        $tags = Tag::all();

        if ($request->ajax()) {
            return view('admin.partials.presult', compact('posts','categories','tags'));
        }


      return view('admin.posts.create',compact('posts','categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'title' =>'required|max:255',
            'category' => 'required',
            'tags'      => 'required',
            'writing'  => 'required',
            'featured' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
         $tags = $request->tags;
         //an array of tags(numbers)
         $tags = array_map('intval', explode(',', $tags));


        $featured = $request->featured;
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move("images",$featured_new_name);

        $post = Post::create(['title'=>$request->title,"category_id"=>$request->category,'featured'=>$featured_new_name,'content'=>$request->writing]);
        $post->tags()->attach($tags);




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

        $post = Post::find($id);
        $category_name = $post->category->name;
        $tags = $post->tags;
       //returning two collections merged
        $data = array_merge($post->toArray(), $tags->toArray());
        $data[] =  $category_name;
        return $data;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        $this->validate($request,[
            'title' =>'required|max:255',
            'category' => 'required',
            'tags'      => 'required',
            'writing'  => 'required',

        ]);

        $id = $request->id;
        $post =  Post::find($id);


        $post->title= $request->title;
        $post->category_id = $request->category;

        $post->content = $request->writing;

        $tags = $request->tags;
        //an array of tags(numbers)
        $tags = array_map('intval', explode(',', $tags));

        $post->save();
        $post->tags()->sync($tags);



       $extensions =  ['jpeg','png','jpg','gif','svg'];

        if($request->featured !== "undefined") {
            $featured = $request->featured;
            $featuredExtension = $featured->getClientOriginalExtension();
            $featuredSize = $featured->getClientSize();
            if(in_array($featuredExtension,$extensions) && $featuredSize < 2097152) {
                $old_image_name = $post->featured;
                $featured_new_name = time() . $featured->getClientOriginalName();
                $featured->move("images", $featured_new_name);
                $post->featured = $featured_new_name;

                $post->save();
                unlink('images/' .  $old_image_name);
                $post->tags()->sync($tags);


            } else {

                return response( [
                    'errors' => ['Only images that are not bigger than 2mb are allowed  !']
                ],422);
            }
        }



            $post->save();
            $post->tags()->sync($tags);










//        Post::create(['title'=>$request->title,"category_id"=>$request->category,'featured'=>$featured_new_name,'content'=>$request->writing]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return Request
     * @throws \Exception
     */


    public function destroy(Request $request)
    {

        $id = $request->id;
        $post= Post::find($id);
        $post->delete();
        unlink('images/' . $post->featured);


    }
}
