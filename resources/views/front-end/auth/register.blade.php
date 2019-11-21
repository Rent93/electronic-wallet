@extends('front-end.master')

@section('title', 'Login page')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-info text-white">Register</div>
                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username: </label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" id="username" name="username" placeholder="Your username">
                        </div>
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Your name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="Your email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password: </label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                        </div>

                        <button class="btn btn-info btn-block" type="submit">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
