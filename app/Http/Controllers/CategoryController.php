<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;

class CategoryController extends Controller {
    
    public function __construct() {
        $this->middleware('admin')->only(['create','store']);
    }

    public function index() {
        return view('landing', array('categories' => Category::all()));
    }

    public function show($id) {
        if (Post::where('category_id', $id)->exists()) {
            return view('category_posts', array('category' => Category::find($id)->name, 'posts' => Post::where('category_id', $id)->get()));
        } else {
            return redirect('post/new')->withMessage('The are no posts currently in ' . Category::Find($id)->name . ' category! Help us and create new posts!');
        }
    }

    public function create() {
        return view('category_create');
    }

    public function store(Request $request) {
        $data = $request->all();

        $rules = $rules = array(
            'name' => 'required|min:3|max:191|unique:categories',
            'description' => 'required|min:3|max:10000',
        );

        $this->validate($request, $rules);

        $category = new Category();
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->save();
        return redirect('admin')->with('message', 'Category ' . $data['name'] . ' added!');
    }

}
