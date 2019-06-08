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
    <div class="row">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="https://thumbs.dreamstime.com/img/thumbsetc/thumb-audio.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://cdn.pixabay.com/photo/2018/02/09/21/46/rose-3142529__340.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=format%2Ccompress&cs=tinysrgb&dpr=1&w=500" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div> 
</div>
<script>
    $('.carousel').carousel({
        interval: 2000;
    });
</script>
@endsection
