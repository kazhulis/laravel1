@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col"># of posts</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr @if($user->role == 3) class="table-danger" @endif>
                <th scope="row">{{$user->id}}</th>
                <td><a href="{{route('user', ['id' => $user->id])}}">{{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td>{{count($user->posts)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$users->links()}}
</div>
@endsection
