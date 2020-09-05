@extends('layouts.app')
@section('title', 'Report')
@section('content')
    <div class="container text-center" style="margin-bottom: 100px">
        @foreach ($cards as $card)

                <div class="card mb-3">
                    <div class="card-header"><h4>{{$card['m'].'/'.$card['y']}}</h4></div>
                    <div class="card-body row">
                        <div class="col">
                            <h5 class="card-title"><i class="fas fa-car fa-2x"></i></h5>
                            <p class="card-text"><h2>{{$card['d']}}</h2></p>
                        </div>
                        <div class="col">
                            <h5 class="card-title"><i class="fas fa-shopping-cart fa-2x"></i></h5>
                            <p class="card-text"><h2>{{$card['p']}}</h2></p>
                        </div>
                        <div class="col">
                            <h5 class="card-title"><i class="fas fa-equals fa-2x"></i></h5>
                            <p class="card-text"><h2>{{$card['t']}}</h2></p>
                        </div>
                    </div>
                    <a href="{{url('report').'/'.$card['y'].'/'.$card['m']}}" class="stretched-link"></a>
                </div>

        @endforeach
    </div>
    @include('_partials._modalAdd')
    @include('_partials._toolbar')
@endsection
