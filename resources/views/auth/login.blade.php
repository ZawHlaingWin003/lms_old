@extends('layout.app')

@section('navbar')
    <x-navbar/>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <h1 class="card-header h1">Login</h1>
                <div class="card-body">
                    <form action="{{ route('auth.login') }}" method="POST">
                        @csrf
                        <div class="row">
                            @if (session('login_error'))
                                <div class="col-12">
                                    <div class="col-12 alert alert-danger" role="alert"> 
                                        {{ session('login_error') }}
                                    </div>
                                </div>
                            @endif
                            <div class="col-12 mb-4">
                                <div class="col-12">
                                    <label for="login_uname" class="form-label">Username</label>
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="login_uname" name="username" placeholder="Enter your username">
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="col-12">
                                    <label for="login_pass" class="form-label">Password</label>
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="login_pass" name="password" placeholder="Enter your password">
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="col-12">
                                    <input class="form-check-input me-2" type="checkbox" name="remember" id="login_remember">
                                    <label class="form-check-label" for="login_remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <input type="submit" class="btn btn-primary" value="Login">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection