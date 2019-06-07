@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex row">
            @foreach ($categories as $category)
            <div class="col-lg-3 col-sm-4 col-xs-2">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">{{ ucfirst($category->name) }} ({{ count($category->posts) }} items)</div>
                    <div class="card-body">
                        <p class="card-text">{{ $category->description }}</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><a href="/category/{{$category->id}}">Go to {{ strtolower($category->name) }} category!</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
