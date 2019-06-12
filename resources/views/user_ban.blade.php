@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #343A40">
            <li class="breadcrumb-item"><a href="{{route('admin')}}" style="color: white">Administrator's panel</a></li>
            <li class="breadcrumb-item active" aria-current="page">Viewing a user</li>
        </ol>
    </nav>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-4">
                <h3>{{ $user->name }}</h3>
                <h6>Email: {{ $user->email }}</h6>
                <h6>Role: 
                    @switch($user->role)
                    @case(1)
                        <span>Regular user</span>
                        @break
                    @case(2)
                        <span>Administrator</span>
                        @break
                    @case(3)
                        <span class='text-danger'>Blocked user</span>
                        @break
                    @endswitch
                </h6>
                <h6>Created at: {{$user->created_at}}</h6>
            </div>
                        @switch($user->role)
                        @case(1)
                            <a class='btn btn-danger' href="{{route('ban',$user->id)}}">Block a user</a>
                            @break
                        @case(3)
                            <a class='btn btn-success' href="{{route('ban',$user->id)}}">Unblock a user</a>
                            @break
                        @endswitch
        </div>
        <div class="d-flex row mt-4">
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
                        <a href="{{route('admin_delete', ['id' => $post->id])}}" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger float-right">Delete</a>
                </div>
            </div>
        </div>
        @endforeach
    </div> 
        
    </div>
</div>
@endsection

