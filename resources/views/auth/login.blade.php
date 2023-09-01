<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@extends('layouts.app')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <li>Email atau Password Salah!</li>
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="login-page">
        <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
            <div class="container">
               
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-4 col-lg-5">
                        <div class="login-box bg-white box-shadow border-radius-10 shadow">
                        <div class="col-md-12">
                        <img src="{{ asset('assets/images/Logo1.png') }}" alt="Foto Logo" />
                    </div>
                            <div class="login-title">
                               
                                <br>
                                <h2 class="text-center text-info">Masuk ke Akun Anda</h2>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <label>Email</label>
                                <div class="input-group custom">
                                    <input type="text" class="form-control form-control-lg" 
                                        name="email" maxlength="45" required/>
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"></span>
                                    </div>
                                </div>
                                <label>Password</label>
                                <div class="input-group custom">
                                    <input type="password" class="form-control form-control-lg"
                                        name="password" id="password" maxlength="40" required/>
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><button type="button" id="togglePassword" class="border-0 bg-transparent"><i class="bi bi-eye-slash"></i></button></span>
                                       
                                    </div>
                                </div>
                                <div class="row pb-30">
                                    
                                    <div class="col-12">
                                        <div class="forgot-password">
                                            <a href="{{ route('password.forgot') }}" class="text-info">Lupa
                                                Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                            <button type="submit" class="btn btn-info btn-lg btn-block">Login</button>
                                        </div>
                                       
                                        <div class="input-group mt-3">
                                            <a class="btn btn-info btn-lg btn-block" href="{{ route('register') }}">
                                                Daftar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#togglePassword').click(function() {
                var passwordField = $('#password');
                var passwordFieldType = passwordField.attr('type');

            // Toggle password field type
            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $(this).html('<i class="bi bi-eye">');
            } else {
                passwordField.attr('type', 'password');
                $(this).html('<i class="bi bi-eye-slash">');
            }
            });
        });
        </script>
    @endsection
