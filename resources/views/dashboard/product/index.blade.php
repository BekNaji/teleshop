@extends('layouts.dashboard')
@section('title','Product List')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card ">
            <div class="card-body">
                @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
                <h3>Product List</h3><hr>
                <a href="{{route('product.create')}}" class="btn btn-primary mb-3">Add</a>
                
                @if(Auth::user()->company->product_page == 'list')
                <input class="form-control" type="text" placeholder="Qidirish" id="search">
                <hr>
                <div class="table-responsive">    
                    <table class="table table-bordered table-striped" id="table">
                        <thead>
                            <tr>
                                <td>#</td> 
                                <td><b>NO</b></td> 
                                <td><b>Link</b></td> 
                                <td><b>Nomi</b></td>
                                <td><b>Olish TL</b></td>
                                <td><b>Olish Dollr</b></td>   
                                <td><b>Sotish Dollr</b></td>
                                <td><b>Foyda</b></td>
                                <td>#</td>
                            </tr>    
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                        <tr>
                        <td>{{$loop->iteration}}</td> 
                        <td>{{ $product->number }}</td> 
                        <td><a href="{{$product->link}}" target="_blank">Link</a></td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->fee_buy}} TL</td>
                        <td>{{$product->fee_buy_dollr}} $</td>
                        <td>{{$product->fee_sell}} $</td>
                        <td>{{$product->profit}} $</td>
                        <td>
                        <a href="{{route('product.edit',$product->id)}}" class="btn btn-warning">Edit</a>
                        <a href="{{route('product.remove',$product->id)}}" class="btn btn-danger">Remove</a>
                        </td>
                            
                        </tr>
                        @endforeach 
                        </tbody>    
                    </table> 
                </div> 
                @endif
                @if(Auth::user()->company->product_page == 'box')
                <input class="form-control" type="text" placeholder="Qidirish" id="search-box">
                <hr>
                @endif
            </div>    
        </div>
        @if(Auth::user()->company->product_page == 'box')
        <div class="row" id="box">
            @foreach ($products as $product)
            <div class="col-sm-4 mt-3 names">
                <div class="card ">
                    <div class="card-body ">
                    <div class="d-flex flex-row images" >
                    @foreach ($product->images as $image)
                    <img class="img-fluid " src="{{asset($image->link)}}" alt="">
                    @endforeach
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 border-left ">
                            <p><b>Nomi: </b>{{$product->name}}</p>
                            <p><b>Kod: </b>{{$product->number}}</p>
                            <p><b>Olingan Narx: </b>{{$product->fee_buy_dollr}} $</p>
                            <p><b>Sotish Narxi: </b>{{$product->fee_sell}} $</p>
                            <p><b>Foyda: </b>{{$product->profit}} $</p>
                        </div>
                    </div>
                    <hr>
                <a href="{{route('product.edit',$product->id)}}" class="btn btn-warning">Edit</a>
                <a href="{{route('product.remove',$product->id)}}" class="btn btn-danger">Remove</a>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
        @endif
    </div> 
</div>   
<style>
.images {
    height: 200px; 
    overflow-x: auto;
    overflow-y: hidden
}


</style>     
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/jcarousel@0.3.9/dist/jquery.jcarousel.min.js"></script>

<script>
    
$(document).ready(function() {
    
    $(document).on('keyup','#search',function() {
        var value = $(this).val().toLowerCase();
        $('#table tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    $(document).on('keyup','#search-box',function() {
        var value = $(this).val().toLowerCase();
        $('#box .names').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

  
});    
</script> 
@endsection