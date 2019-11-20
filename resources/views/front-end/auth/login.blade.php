@extends('front-end.master')

@section('title', 'Login page')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-info text-white">Login</div>
                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username: </label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>

                        <button class="btn btn-info btn-block" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
