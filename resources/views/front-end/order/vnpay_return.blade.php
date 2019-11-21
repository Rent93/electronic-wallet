@extends('front-end.master')

@section('title', 'VNPay Response')


{{-- http://localhost:8000/vnpay/payment?
vnp_Amount=5000000
vnp_BankCode=NCB
vnp_BankTranNo=20191121150906
vnp_CardType=ATM
vnp_OrderInfo=This+one+just+to+test+payment
vnp_PayDate=20191121150857
vnp_ResponseCode=00
vnp_TmnCode=TM8ZS8CX
vnp_TransactionNo=13196308
vnp_TxnRef=20191121080846
vnp_SecureHashType=SHA256&
np_SecureHash=856e481e74406c2b5cfc61eca2cc40672aeee7e62689b07cc6dc875a7b3166b2 --}}
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-info text-white">
                    Result your payment
                </div>
                <div class="card-body">

                    @if ( request()->vnp_ResponseCode == '00' )
                        <div class="alert alert-success alert-dismissible mt-3">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Your payment was successful</strong>
                        </div>
                        <table class="table table-striped table-bordered table-hover mt-3">
                            <tbody>
                            <tr>
                                <td>Amount</td>
                                <td>{{ number_format( request()->vnp_Amount / 100, 2) }} VNĐ</td>
                            </tr>
                            <tr>
                                <td>Bank</td>
                                <td>{{ request()->vnp_BankCode }}</td>
                            </tr>
                            <tr>
                                <td>Transaction number</td>
                                <td>{{ request()->vnp_TransactionNo }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{ str_replace('+', ' ', request()->vnp_OrderInfo) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-warning alert-dismissible mt-3">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Something went wrong!</strong>
                        </div>
                    @endif

                </div>
                <div class="card-footer">
                    <a href="{{ route('order.create') }}" class="btn btn-info">New order</a>
                </div>
            </div>
        </div>
    </div>
@endsection
