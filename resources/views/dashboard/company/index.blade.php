@extends('layouts.dashboard')
@section('title','Company List')
@section('content')

<div class="card shadow">
    <div class="card-body">
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        <h3>Company List</h3><hr>
        <a href="{{route('company.create')}}" class="btn btn-primary">Add</a>
        <hr>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>#</td> 
                    <td>Status</td>
                    <td>Name</td>   
                    <td>#</td>
                </tr> 
            </thead>
            <tbody>
                @foreach ($companies as $company)
                <tr>
                    <td>{{$loop->iteration}}</td> 
                    <td>@if($company->status == 1)
                        <span class="badge badge-success">Enabled</span>                
                        @else
                        <span class="badge badge-danger">Disabled</span> 
                        @endif
                    </td>
                    <td>{{$company->name}}</td>   
                    <td>
                    <a href="{{route('company.edit',$company->id)}}" class="btn btn-warning">Edit</a>
                    <a href="{{route('company.remove',$company->id)}}" class="btn btn-danger">Remove</a>
                    </td>
                </tr>
                @endforeach
            </tbody>    
        </table>   
    </div>    
</div>    
        
@endsection