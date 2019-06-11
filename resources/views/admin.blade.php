@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <h1>Administrator options</h1>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #343A40">
            <li class="breadcrumb-item active" aria-current="page">Administrator</li>
        </ol>
    </nav>
    @if(session()->has('message'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('message') }}
    </div>
    @endif     

    <div class="row justify-content-center">
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Administrator Panel</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="{{ url('category/create') }}">Add a new category</a></li>
                        <li class="list-group-item"><a href="{{ url('admin/ban') }}">Block a user</a></li>
                        <li class="list-group-item"><a href="{{ url('admin/orders') }}">View all user orders</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
