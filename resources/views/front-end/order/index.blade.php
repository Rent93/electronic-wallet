@extends('front-end.master')

@section('title', 'VNPay Demo')

@section('content')
    <div class="row">
        <div class="col-md-12">
            This one just to test for now...
            @foreach($orders as $order)
                {{ $order->code }} <br>
            @endforeach
        </div>
    </div>
@endsection
