@extends('layouts.app')

@section('content')
<div class='container'>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">You are editing your post!</div>
                <div class="card-body">
                    {!! Form::model($post, ['method' => 'PUT','action' => ['PostController@update', $post->id], 'class' => 'form-horizontal', 'files' => true, 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group row">
                        {!! Form::label('title', 'Post title', ['class' => 'col-md-4 control-label text-md-right']) !!}
                        <div class="col-md-6">
                            {!! Form::text('title', $post->title , ['class' => 'form-control '.($errors->has('title') ? ' is-invalid' : '' )]) !!}   
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
                            {!! Form::textArea('description', $post->description, ['class' => 'form-control '.($errors->has('description') ? ' is-invalid' : '' )]) !!}                     
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
                            {!! Form::select('category', $categories, $post->category_id, ['class' => 'form-control '.($errors->has('category') ? ' is-invalid' : '' )]) !!}
                            @if ($errors->has('category'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('price', 'Price', ['class' => 'col-md-4 control-label text-md-right']) !!}
                        <div class="col-md-6">
                            {!! Form::number('price', $post->price, ['class' => 'form-control '.($errors->has('price') ? ' is-invalid' : '' ), 'min' => 0, 'max' => 1000000, 'step' => 0.01, 'placeholder' => '30.04']) !!}
                            @if ($errors->has('price'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('price') }}</strong>
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
