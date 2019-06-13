@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-left">{{$category}}</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #343A40">
            <li class="breadcrumb-item"><a href="{{route('categories')}}" style="color: white">{{__('navbar.categories')}}</a></li>
            <li class="breadcrumb-item active">{{$category}}</li>
        </ol>
    </nav>
    <div class='row mb-3'>
        <div class="col-6">
            Sort by creation date:
            <a class="btn btn-secondary" href="{{url()->current()}}/?sort=desc" role="button">{{__('tables.newest')}}</a>
            <a class="btn btn-secondary" href="{{url()->current()}}/?sort=asc" role="button">{{__('tables.oldest')}}</a>
        </div>
    </div>
    <div class="row ml-1 mr-1">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">{{__('tables.thumbnail')}}</th>
                    <th class="w-50" scope="col">{{__('tables.title')}}</th>
                    <th scope="col">{{__('tables.date')}}</th>
                    <th scope="w-25">{{__('tables.price')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td><img src="{{asset($post->pictures->first()->thumbnail)}}" alt="Thumbnail" style="max-height: 100px;"></img></td>
                    <td><a href="{{route('post',['id' => $post->id])}}">{{$post->title}}</td>
                    <td>{{$post->created_at}}</td>
                    <td><span class='text-success'><b>{{$post->price}} €</b></span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class='d-flex justify-content-center'>{{ $posts->links() }}</div>
</div>
@endsection
