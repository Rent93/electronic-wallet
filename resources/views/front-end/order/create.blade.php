@extends('front-end.master')

@section('title', 'Create new Order')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    Create new order.
                </div>
                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="order_type">Order type:</label>
                            <select name="order_type" class="form-control" id="order_type">
                                <option>--Select--</option>
                                <option value="1">Top up your phone account</option>
                                <option value="2">Pay the bill</option>
                                <option value="3">Fashion</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="number" name="amount" class="form-control" id="amount" placeholder="Amount" autocapitalize="off">
                        </div>
                        <div class="form-group">
                            <label for="content">Amount:</label>
                            <textarea name="content" class="form-control" id="content" cols="30" rows="4" placeholder="Content of order"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
