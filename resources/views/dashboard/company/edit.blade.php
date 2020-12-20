@extends('layouts.dashboard')
@section('title','Edit Company')
@section('content')

<div class="card shadow col-sm-6 offset-sm-3">
    <div class="card-body">
        <h3>Company Edit</h3><hr>
    <form action="{{route('company.update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$company->id}}">
        <div class="form-group">
            <label for="">Status</label>
            <select class="form-control" name="status">
                <option {{$company->status == 1 ? 'selected' : ''}} value="1">Enable</option>
                <option {{$company->status == 0 ? 'selected' : ''}} value="0">Disable</option>  
            </select>
        </div>
        <div class="form-group">
            <label for="">Name</label>
            <input value="{{$company->name}}" class="form-control" type="text" name="name">
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form> 
    </div>    
</div>    
        
@endsection