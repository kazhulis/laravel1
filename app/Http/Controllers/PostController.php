<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Picture;
use Auth;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->only(['create','store','index']);
    }
    
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
        return view('create_post', ['categories' => Category::all()->sortBy('name')->pluck('name','id')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $rules = array(
            'title' => 'required|min:3|max:200',
            'description' => 'required|min:3|max:10000',
            'category' => 'required|exists:categories,id',
            'price' => ['required', 'regex:/^(?:[1-9]\d*|0)?(?:\.\d+)?/', 'not_in:0'],
            'image.*' => 'required|image|max:1999',
        );
        
        $messages = [
            'title.max' => 'Title should be less than 200 characters!',
            'price' => 'The price you\'ve entered is in a wrong format!',
            'image.max' => 'The maximum image size is 2MB!',
            'image.image' => 'The uploaded file should be an image!',
        ];
        
        $this->validate($request, $rules, $messages);
        
        //Create a new post
        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->price = $request->price;
        $post->category_id = $request->category;
        $post->save();
        
        
        $ImgFolder = 'public/upload/';
        foreach ($request->image as $image) {
            $imgExt = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $imgExt;
            $image->storeAs($ImgFolder, $filename);
            
            $picture = new Picture;
            $picture->post_id = $post->id;
            $picture->path = $ImgFolder . $filename;
            $picture->save();
        }
        
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
        $post = Post::FindOrFail($id);
        return view('post', ['post' => $post]);
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
