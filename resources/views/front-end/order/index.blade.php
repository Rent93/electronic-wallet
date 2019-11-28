@extends('front-end.master')

@section('title', 'VNPay Demo')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Orders created</h2>

            <table class="table table-hover table-bordered table-orders">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Author</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <th>Content (Message)</th>
                    <th>Status</th>
                    <th>IP Address</th>
                    <th>Date created</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->code }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->amount }}</td>
                        <td>{{ $order->currency }}</td>
                        <td>{{ $order->content }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->ip_address }}</td>
                        <td>{{ $order->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </div>
@endsection
