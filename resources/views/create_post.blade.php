@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #343A40">
            <li class="breadcrumb-item"><a href="{{route('categories')}}" style="color: white">{{__('navbar.categories')}}</a></li>
            <li class="breadcrumb-item active">Creating a new post!</li>
        </ol>
    </nav>
    @if(session()->has('message'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Add your new post</div>
                <div class="card-body">
                    {!! Form::open(['action' => 'PostController@store', 'files' => true, 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

                    <div class="form-group row">
                        {!! Form::label('title', 'Post title', ['class' => 'col-md-4 control-label text-md-right']) !!}
                        <div class="col-md-6">
                            {!! Form::text('title', '', ['class' => 'form-control '.($errors->has('title') ? ' is-invalid' : '' )]) !!}   
                            @if ($errors->has('title'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif 
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('description', 'Description', ['class' => 'col-md-4 control-label text-md-right']) !!}
                        <div class="col-md-6">
                            {!! Form::textArea('description', '', ['class' => 'form-control '.($errors->has('description') ? ' is-invalid' : '' )]) !!}                     
                            @if ($errors->has('description'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif                    
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('category', 'Category', ['class' => 'col-md-4 control-label text-md-right']) !!}
                        <div class="col-md-6">
                            {!! Form::select('category', $categories, '', ['class' => 'form-control '.($errors->has('category') ? ' is-invalid' : '' )]) !!}
                            @if ($errors->has('category'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

