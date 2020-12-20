@extends('layouts.dashboard')
@section('title','Edit Company')
@section('content')

<div class="card shadow col-sm-6 offset-sm-3">
    <div class="card-body">
        <h3>Company Create</h3><hr>
    <form action="{{route('company.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Status</label>
            <select class="form-control" name="status">
                <option value="1">Enable</option>
                <option value="0">Disable</option>  
            </select>
        </div>
        <div class="form-group">
            <label for="">Name</label>
            <input value="{{Request::old('name')}}" class="form-control" type="text" name="name">
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form> 
    </div>    
</div>    
        
@endsection