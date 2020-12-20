@extends('layouts.dashboard')
@section('title','User List')
@section('content')

<div class="card shadow">
    <div class="card-body">
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        <h3>Users List</h3><hr>
        <a href="{{route('user.create')}}" class="btn btn-primary">Add</a>
        <hr>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>#</td> 
                    <td>Role</td>
                    <td>Name</td>   
                    <td>Email</td>
                    <td>#</td>
                </tr>    
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>#</td>
                    <td>
                        @if($user->role == 0)
                        <span class="badge badge-success">Root</span>
                        @else
                        <span class="badge badge-primary">User</span>
                        @endif
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                    <a href="{{route('user.edit',$user->id)}}" class="btn btn-warning">Edit</a>
                    <a href="{{route('user.remove',$user->id)}}" class="btn btn-danger">Remove</a>
                    </td>
                </tr>
                @endforeach
                    
            </tbody>    
        </table>   
    </div>    
</div>    
        
@endsection