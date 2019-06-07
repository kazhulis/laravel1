@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-left">{{$category}}</h1>
    <div class="row justify-content-center">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Creation date</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->price}} €</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
