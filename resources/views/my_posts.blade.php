@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #343A40">
            <li class="breadcrumb-item"><a href="{{route('categories')}}" style="color: white">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home page</li>
        </ol>
    </nav>
    @if (Auth::user()->isBlocked())
    <div class="alert alert-danger" role="alert">
        You are banned for undisclosed reasons! You cannot post, edit or delete posts.
    </div>
    @endif
    
    @if(session()->has('errors'))
    <div class="alert alert-danger" role="alert">
        {{ session()->get('errors')->first() }}
    </div>
    @endif  
    <div class="d-flex row">
        @foreach ($posts as $post)
        <div class="col-lg-3 col-sm-4 col-xs-2">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="img-thumbnail" style="height: 210px;display: flex;flex-direction: column;justify-content: center;">
                    <img class="card-img-top" style="max-height: 200px; " src="{{ asset($post->pictures->first()->thumbnail) }}" alt="Title image">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <h4 class="card-text text-success"><b>€{{$post->price}}</b></p>
                        <a href="{{route('post', ['id' => $post->id])}}" class="btn btn-light">View</a>
                        <a href="{{route('edit', ['id' => $post->id])}}" class="btn btn-light">Edit</a>
                        <a href="{{route('delete', ['id' => $post->id])}}" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger float-right">Delete</a>
                </div>
            </div>
        </div>
        @endforeach
    </div> 

</div>
@endsection
