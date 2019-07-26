@extends('layouts.app')
@section('title', trans('Home'))
@section('content')
<div class="container text-center" style="top:0; position:absolute; width:100%;">
    <div class="row">
        <div class="col p-4 bg-warning">
            <i class="fas fa-car fa-2x text-white"></i> <h2 class="d-inline text-white pl-4">{{$total['Driver']}}</h2>
        </div>
        <div class="col p-4 bg-secondary">
            <i class="fas fa-shopping-cart fa-2x text-white"></i><h2 class="d-inline text-white pl-4">{{$total['Shop']}}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col p-2 text-center bg-info">
            <i class="fas fa-equals fa-2x text-white d-inline"></i><h2 class="d-inline text-white pl-4">{{$total['all']}}</h2>
        </div>
    </div>
</div>
    <table class="table w-100 text-center" style="position:absolute;top:140px;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">#</th>
                <th scope="col">Amount</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($amounts as $amount)
                <tr class="bg-@if($amount->typeOfamount==1)warning @elseif($amount->typeOfamount==2)secondary text-white @endif">
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
