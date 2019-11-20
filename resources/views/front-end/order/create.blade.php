@extends('front-end.master')

@section('title', 'Create new Order')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-info text-white">
                    Create new order.
                </div>
                <div class="card-body">
                    <form action="{{ route('order.store') }}" method="POST" id="payment-form">
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
                            <label for="name">Name:</label>
                            <input type="text" name="name" value="Nguyen Minh Tuan" class="form-control" id="name" placeholder="Your name"
                                   autocapitalize="off">
                        </div>
                        <div class="form-group">
                            <label for="amount">Email:</label>
                            <input type="email" name="email" value="tuan.ltv.110893@gmail.com" class="form-control" id="email" placeholder="Your email"
                                   autocapitalize="off">
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="number" name="amount" value="5" class="form-control" id="amount" placeholder="Amount"
                                   autocapitalize="off">
                        </div>
                        <div class="form-group">
                            <label for="content">Content of payment:</label>
                            <textarea name="content" class="form-control" id="content" cols="30" rows="4"
                                      placeholder="Content of order">This one just to test payment</textarea>
                        </div>

                        <div class="form-group">
                            <div id="card-element">
                                <!-- Elements will create input elements here -->
                            </div>
                        </div>

                        <!-- We'll put the error messages in this element -->
                        <div class="form-group">
                            <div id="card-errors" role="alert"></div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-info">Proceed to payment</button>
                        </div>
                    </form>

                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
