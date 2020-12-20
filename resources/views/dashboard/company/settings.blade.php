@extends('layouts.dashboard')
@section('title','Settings')
@section('content')

<div class="row">
    <div class="col-sm-6 offset-sm-3">
        <div class="card shadow">
            <div class="card-body">
                @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
                <h3>Settings</h3><hr>
                
            <form action="{{route('settings.update')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Maxsulot raqami boshlanishi</label>
            <input value="{{Request::old('product_row') ?? $user->company->product_row}}" class="form-control" type="text" name="product_row" id="">
            </div>
            <div class="form-group">
                <label for="">Dollr Narxi</label>
            <input value="{{Request::old('dollr') ?? $user->company->dollr}}" class="form-control" type="number" step="0.1" name="dollr" id="">
            </div>
            <div class="form-group">
                <label for="">Product List Ko'rinishi</label><br>
                <select class="form-control" name="product_page" id="">
                    <option {{$user->company->product_page == 'list' ? 'selected':''}} value="list">List</option>
                    <option {{$user->company->product_page == 'box' ? 'selected':''}} value="box">Box</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Yangilash</button>
            </div>
            
            </form>
            </div>    
        </div>
    </div>
</div>    
        
@endsection