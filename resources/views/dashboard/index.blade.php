@extends('layouts.dashboard')
@section('title','Dashboard')
@section('content')

<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h3>Bosh Sahifa</h3><hr>
                <p>Assalomu Aleykum</p>
                <p>Bu Programma Siz Bozorchilar uchun</p> 
                <p>Bu Programma orqali siz sotayotgan mahsulotlaringizni osonlik bilan kontrol qishingiz mumkin! <br> Misol uchun siz Telgram kanalida Turkiydagi mahsulotlarini sotyabsiz. Mahsulotlarni internet orqali buyurma bermoqdasiz. Internetdan mahsulot topdingiz va uni olish narxi va sotish narxini bir qog'ozga yoki telefon kompyuteringizga yozib qo'ydingiz. Bu malumotlarga har doim ham erisha olmaysiz shu sababli bu programmani ishlatsangiz ishonamanki sizni ishingizni anchagina osonlashtiradi</p>   
            </div>    
        </div>
    </div>

    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <canvas id="profit"></canvas>
            </div>    
        </div>
    </div>

    <div class="col-sm-6 mt-4">
        <div class="card">
            <div class="card-body">
                <canvas id="prodcut_count"></canvas>
            </div>    
        </div>
    </div>

    <div class="col-sm-6 mt-4">
        <div class="card">
            <div class="card-body">
                <canvas id="pie"></canvas>
            </div>    
        </div>
    </div>
</div>
    
        
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('js/chart/Chart.min.css')}}">  
@endsection
@section('script')
<script src="{{asset('js/chart/Chart.min.js')}}"></script>
@include('dashboard.dashboard.profit')
@include('dashboard.dashboard.product_count')
@include('dashboard.dashboard.pie')
@endsection
