@extends('layouts.dashboard')
@section('title','Create User')
@section('content')

<div class="card shadow col-sm-6 offset-sm-3">
    <div class="card-body">
        <h3>User Create</h3><hr>
    <form action="{{route('user.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Companies</label>
            <select class="form-control" name="company_id" required>
                <option value="" disabled selected>Select Company</option>
                @foreach ($companies as $company)
                <option value="{{$company->id}}">{{$company->name}}</option>   
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Role</label>
            <select class="form-control" name="role" required>
                <option value="1">User</option>
                <option value="0">Root</option>  
            </select>
        </div>
        <div class="form-group">
            <label for="">Name</label>
            <input value="{{Request::old('name')}}" class="form-control" type="text" name="name" required>
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input required value="{{Request::old('email')}}" class="form-control" type="email" name="email">
            @error('email')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input required class="form-control" type="password" name="password">
            @error('password')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form> 
    </div>    
</div>    
        
@endsection