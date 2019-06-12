<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Picture;

class AdminController extends Controller {

    public function __construct() {
        $this->middleware('admin');
    }

    public function __invoke() {
        return view('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user($id) {
        $user = User::FindOrFail($id);
        $posts = Post::where('user_id', $id)->get();

        return view('user_ban', ['user' => $user, 'posts' => $posts]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ban($id) {
        $user = User::FindOrFail($id);
        if ($user->role == 3) {
            $user->role = 1;
        } else if ($user->role == 1) {
            $user->role = 3;
        }
        $user->save();

        return redirect()->action(
                        'AdminController@user', ['id' => $id]
        );
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

            Picture::where('post_id', $post->id)->delete();
            $post->delete();

            return redirect()->action(
                        'AdminController@user', ['id' => $post_owner]
        );
        }
}
