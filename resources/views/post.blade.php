@extends('layouts.app')

@section('content')
<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #343A40">
            <li class="breadcrumb-item"><a href="{{route('categories')}}" style="color: white">{{__('navbar.panel')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('category',['id' => $post->category_id])}}" style="color: white">{{$post->category->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Post #{{$post->id}}</li>
        </ol>
    </nav>

    
    <div class="mt-3">
    <div class="row justify-content-left">   
        <h1>{{$post->title}}</h1>
        
    </div>
    <h6>Posted by <b>{{ $owner->name }} ({{ $owner->email }})</b> </h6>
    <hr>
        <h5>{{ $post->description }}</h5><br>
        <hr>
    

    </div>
    <br>
    @foreach($comments as $comment)
    <div class="row mb-3">
        <div class="card w-50">
            <div class="card-header">
                Comment #{{$comment->id}}
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>{{$comment->comment}}</p>
                    <footer class="blockquote-footer"><b>{{$comment->user->name}} ({{$comment->user->email}})</b></footer>
                </blockquote>
            </div>
        </div>
    </div>
    @endforeach
    <br>
    <h3>Add your comment!</h3>
    {!! Form::open(array('action' => ['PostController@comment', $post->id])) !!}
    {!! Form::textArea('comment','', ['class' => 'col-6 form-control '.($errors->has('comment') ? ' is-invalid' : '' )]) !!}
    
    @if ($errors->has('comment'))
    <span class="invalid-feedback">
        <strong>{{ $errors->first('comment') }}</strong>
    </span>
    @endif  
    
    {!! Form::submit('Comment', ['class' => 'mt-3 btn btn-primary']) !!}
    {!! Form::close() !!}

</div>

@endsection
