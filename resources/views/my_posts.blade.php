@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #343A40">
            <li class="breadcrumb-item"><a href="{{route('categories')}}" style="color: white">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home page</li>
        </ol>
    </nav>
    <div class="d-flex row">
        @foreach ($posts as $post)
        <div class="col-lg-3 col-sm-4 col-xs-2">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="img-thumbnail" style="height: 200px;">
                    <img class="card-img-top" src="{{ asset($post->pictures->first()->path) }}" alt="Title image">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <h4 class="card-text text-success"><b>€{{$post->price}}</b></p>
                        <a href="{{route('post', ['id' => $post->id])}}" class="btn btn-light">Check out this post</a>
                </div>
            </div>
        </div>
        @endforeach
    </div> 

</div>
@endsection
