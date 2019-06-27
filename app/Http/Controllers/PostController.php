<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Auth;
use App\User;
use App\Comment;

class PostController extends Controller {

    public function __construct() {
        $this->middleware('auth')->only(['create', 'store', 'index','destroy','edit','update','comment']);
        $this->middleware('ban')->only(['create','edit','destroy']);
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
        );

        $messages = [
            'title.max' => 'Title should be less than 200 characters!',
        ];

        $this->validate($request, $rules, $messages);

        //Create a new post
        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category;
        $post->save();

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
        $comments = Comment::where('post_id', $id)->get();
        return view('post', ['post' => $post, 'owner' => $owner, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //Check if post owner is the real one
        $post = Post::findOrFail($id);
        $post_owner = $post->user_id;
        if ($post_owner != Auth::id()) {
            abort('404');
        }
        return view('post_update', ['post' => $post, 'categories' => Category::all()->sortBy('name')->pluck('name', 'id')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $rules = $rules = array(
            'title' => 'required|min:3|max:200',
            'description' => 'required|min:3|max:10000',
            'category' => 'required|exists:categories,id',

        );

        $messages = [
            'title.max' => 'Title should be less than 200 characters!',

        ];

        $this->validate($request, $rules, $messages);

        //Create a new post
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category;
        $post->save();
        
        return redirect('home')->withMessage('Your post was successfully edited!');
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
    
    public function comment(Request $request, $id) {
        $rules = $rules = array(
            'comment' => 'required|min:3|max:200',
        );

        $this->validate($request, $rules);

        //Create a new post
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->post_id = $id;
        $comment->user_id = Auth::id();
        $comment->save();
        
        return redirect()->action('PostController@show', $id);
    }
}
