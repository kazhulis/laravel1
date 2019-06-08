@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-left">{{$category}}</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #343A40">
            <li class="breadcrumb-item"><a href="{{route('categories')}}" style="color: white">Categories</a></li>
            <li class="breadcrumb-item active">{{$posts[0]->category->name}}</li>
        </ol>
    </nav>
    <div class="row ml-1 mr-1">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th class="w-25" scope="col">Creation date</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{$post->created_at}}</td>
                    <td><a href="{{route('post',['id' => $post->id])}}">{{$post->title}}</td>
                    <td>{{$post->price}} €</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
