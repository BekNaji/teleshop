@extends('layouts.dashboard')
@section('title','Edit Product')
@section('content')
<div class="row">
    
    <div class="col-sm-12 mb-4">
    <a href="{{route('product.index')}}" class="btn btn-primary ">Orqaga</a>
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    
    <div class="col-sm-6 mb-3">
        <div class="card shadow ">
            <div class="card-body">
                <h3>Yangilash</h3><hr>
            <form action="{{route('product.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$product->id}}">
                <div class="form-group">
                    <label for="">Link</label>
                    <input value="{{Request::old('link') ?? $product->link}}" class="form-control" type="text" name="link" required>
                    @error('link')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Nomi</label>
                    <input value="{{Request::old('name') ?? $product->name}}" class="form-control" type="text" name="name" required>
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-row">
                        <div class="col-sm-6">
                            <label for="">Olish Narxi TL</label>
                            <input id="fee_buy" value="{{Request::old('fee_buy') ?? $product->fee_buy}}" class="form-control" type="text" name="fee_buy" required>
                            @error('fee_buy')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <label for="">Dollr</label>
                            <input id="fee_buy_dollr" value="{{Request::old('fee_buy_dollr') ?? $product->fee_buy_dollr}}" class="form-control" type="text" name="fee_buy_dollr" required>
                            @error('fee_buy_dollr')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                </div>
                <div class="form-row">
                        <div class="col-sm-6">
                            <label for="">Foiz</label>
                            <input id="interest" value="{{Request::old('interest') ?? $product->interest}}" class="form-control" type="text" name="interest" required>
                            @error('interest')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <label for="">Sotish Narxi $</label>
                            <input id="fee_sell" value="{{Request::old('fee_sell') ?? $product->fee_sell}}" class="form-control" type="text" name="fee_sell" required>
                            @error('fee_sell')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                </div>
                <div class="form-group custom-file mt-3">
                    <input id="images" class="custom-file-input" type="file" name="images[]" multiple="multiple" >
                    <label class="custom-file-label" for="images">Rasm Yuklash</label>
                </div>
                
                <button type="submit" class="btn btn-primary mt-4">Yangilash</button>
            </form> 
            </div>    
        </div> 
    </div> 
    
    <div class="col-sm-6">
        <div class="card shadow">
            <div class="table-responsive card-body">
                <h3>Rasmlar</h3><hr>
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <td><b>#</b></td>
                            <td><b>Image</b></td>
                            <td><b>Show</b></td>
                            <td><b>Delete</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($images   as $image)
                        <tr>

                        <td>{{$loop->iteration}}</td>
                        <td><img style="width: 50px" height="50px;" class="img-fluid" src="{{asset($image->link)}}" ></td>
                        <td><a href="{{asset($image->link)}}" class="btn btn-info">Show</a></td>

                        <td><a href="{{route('image.remove',$image->id)}}"  class="btn btn-danger">Remove</a></td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function() 
    {
        var dollr = "{{ Auth::user()->company->dollr }}";

        $(document).on('keyup','#interest',function() {
            var fee_buy_dollr = Number($('#fee_buy_dollr').val());
            var interest = Number($('#interest').val());
            var fee_sell = ((fee_buy_dollr / 100) * interest) + fee_buy_dollr;
            $('#fee_sell').val(Math.ceil(fee_sell)); 
        });

        $(document).on('keyup','#fee_sell',function() {
           var fee_sell = Number($('#fee_sell').val());
           var fee_buy_dollr = Number($('#fee_buy_dollr').val()); 
           var interest = (fee_sell * 100) / fee_buy_dollr;
           $('#interest').val(Math.ceil(interest - 100));
        });


        $(document).on('keyup','#fee_buy',function() {
            var fee_buy = $('#fee_buy').val();
            var fee_buy_dollr = $('#fee_buy_dollr').val(Math.ceil(fee_buy / dollr));
        })

    });
    
</script>
@endsection