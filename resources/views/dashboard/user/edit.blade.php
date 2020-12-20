@extends('layouts.dashboard')
@section('title','Edit User')
@section('content')

<div class="card shadow col-sm-6 offset-sm-3">
    <div class="card-body">
        <h3>User Edit</h3><hr>
    <form action="{{route('user.update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$user->id}}">
        <div class="form-group">
            <label for="">Companies</label>
            <select class="form-control" name="company_id">
                @foreach ($companies as $company)
                <option {{$user->company_id == $company->id ? 'selected': ''}} value="{{$company->id}}">{{$company->name}}</option>   
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Role</label>
            <select class="form-control" name="role">
                <option {{$user->role == 1 ? 'selected': ''}} value="1">User</option>
                <option {{$user->role == 0 ? 'selected': ''}} value="0">Root</option>  
            </select>
        </div>
        <div class="form-group">
            <label for="">Name</label>
            <input value="{{ $user->name }}" class="form-control" type="text" name="name">
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input value="{{ $user->email }}" class="form-control" type="email" name="email">
            @error('email')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Password - it won't change if you leave it blank </label>
            <input class="form-control" type="password" name="password">
            @error('password')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form> 
    </div>    
</div>    
        
@endsection