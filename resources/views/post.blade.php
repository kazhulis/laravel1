@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <h1>{{$post->title}}</h1>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #343A40">
            <li class="breadcrumb-item"><a href="{{route('categories')}}" style="color: white">Categories</a></li>
            <li class="breadcrumb-item"><a href="{{route('category',['id' => $post->category_id])}}" style="color: white">{{$post->category->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Post #{{$post->id}}</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                @for ($i = 1; $i < count($post->pictures); $i++)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"></li>
                @endfor
            </ol>
            <div class="carousel-inner">
                <?php $counter = 1 ?>
                @foreach ($post->pictures as $picture)
                <div class="carousel-item <?php if ($counter == 1) {
                    echo 'active';
                } ?>">
                    <img class="d-block w-100" src="{{asset($picture->path)}}" alt="slide">
                </div>
<?php $counter++ ?>
                @endforeach
            </div>
            @if (count($post->pictures) > 1)
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            @endif
        </div>
    </div>
    <div class="mt-3">
        <h5>{{ $post->description }}</h5><br>
        <h4 class="text-success"><b> PRICE: €{{ $post->price }}</b></h4>
        <hr>
        <h5><b>Owner's contacts</b></h5>
        <h6>Owner's name: {{ $owner->name }} </h6>
        <h6>E-mail: <b>{{ $owner->email }}</b></h6>
    </div>


</div>

@endsection
