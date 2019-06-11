<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Picture;
use Auth;
use App\User;

class PostController extends Controller {

    public function __construct() {
        $this->middleware('auth')->only(['create', 'store', 'index','destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('my_posts', ['posts' => Post::where('user_id', Auth::id())->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('create_post', ['categories' => Category::all()->sortBy('name')->pluck('name', 'id')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = $rules = array(
            'title' => 'required|min:3|max:200',
            'description' => 'required|min:3|max:10000',
            'category' => 'required|exists:categories,id',
            'price' => ['required', 'regex:/^(?:[1-9]\d*|0)?(?:\.\d+)?/', 'not_in:0'],
            'image' => 'required',
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
            $filename = uniqid();
            $image->storeAs($ImgFolder, $filename . '.' . $imgExt);


            $path = '/storage/upload/' . $filename . '.' . $imgExt;
            $fullpath = public_path() . $path;

            //Change image to jpeg
            $im = new \imagick();

            $im->readImage(public_path() . '/storage/upload/' . $filename . '.' . $imgExt);
            $im->setImageColorspace(255);
            $im->setCompression(\Imagick::COMPRESSION_JPEG);
            $im->setCompressionQuality(80);
            $im->setImageFormat('jpg');

            //write image on server 
            $im->writeImage(public_path() . '/storage/thumbnail/' . $filename . '.jpg');
            $im->clear();
            $im->destroy();

            //MAKE THUMBNAIL
            $desired_width = 200;
            $src = $dest = public_path() . '/storage/thumbnail/' . $filename . '.jpg';

            /* read the source image */
            $source_image = imagecreatefromjpeg($src);
            $width = imagesx($source_image);
            $height = imagesy($source_image);

            /* find the "desired height" of this thumbnail, relative to the desired width  */
            $desired_height = floor($height * ($desired_width / $width));

            /* create a new, "virtual" image */
            $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

            /* copy source image at a resized size */
            imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

            /* create the physical thumbnail image to its destination */
            imagejpeg($virtual_image, $dest);
            //END THUMBNAIL


            $picture = new Picture;
            $picture->post_id = $post->id;
            $picture->path = '/storage/upload/' . $filename . '.' . $imgExt;
            $picture->thumbnail = '/storage/thumbnail/' . $filename . '.jpg';
            $picture->save();
        }

        return redirect('/home')->withMessage('You have successfully added a new post!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $post = Post::FindOrFail($id);
        $owner = User::Find($post->user_id);
        return view('post', ['post' => $post, 'owner' => $owner]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $post = Post::findOrFail($id);
        $post_owner = $post->user_id;
        
        if ($post_owner != Auth::id()) {
            abort('404');
        }
        
        Picture::where('post_id',$post->id)->delete();
        $post->delete();
        
        return redirect('/home')->withMessage('You have successfully deleted a post!');
    }

}
