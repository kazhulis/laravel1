<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;

class CategoryController extends Controller {

    public function index() {
        return view('landing', array('categories' => Category::all()));
    }

    public function show($id) {
        if (Post::where('category_id', $id)->exists()) {
            return view('category_posts', array('category' => Category::find($id)->name, 'posts' => Post::where('category_id', $id)->get()));
        } else {
            abort('404');
        }
    }

}
