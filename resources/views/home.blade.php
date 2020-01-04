@extends('layouts.app')
@section('title', __('Home'))
@section('content')
<div class="fixed-top mx-auto text-center">
    <div class="row">
        <div class="col p-4 bg-car">
            <i class="fas fa-car fa-2x text-white"></i> <h2 class="d-inline text-white pl-4">{{$total['Driver']}}</h2>
        </div>
        <div class="col p-4 bg-shop">
            <i class="fas fa-shopping-cart fa-2x text-white"></i><h2 class="d-inline text-white pl-4">{{$total['Shop']}}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col p-2 text-center bg-primary">
            <i class="fas fa-equals fa-2x text-white d-inline"></i><h2 class="d-inline text-white pl-4">{{$total['all']}}</h2>
        </div>
    </div>
</div>
    <table class="table w-100 text-center text-white" style="position:absolute;top:140px;">
        <thead class="text-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">#</th>
                <th scope="col">Amount</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($amounts as $amount)
                <tr class="bg-@if($amount->typeOfamount==1)car @elseif($amount->typeOfamount==2)shop @endif">
                    <td><i class="fas fa-@if($amount->typeOfamount==1)car @elseif($amount->typeOfamount==2)shopping-cart @endif"></i></td>
                    <th scope="row">{{$amount->id}}</th>
                    <td>{{$amount->amount}}</td>
                    <td>{{$amount->created_at}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@include('_partials._modalAdd')
@include('_partials._toolbar')
@endsection
