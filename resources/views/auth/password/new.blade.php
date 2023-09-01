<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@if (Session::has('success'))
    @extends('layouts.app')
    @section('content')
        <div class="login-page ">
            <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-12 mb-4">
                            {{-- <img src="https://dummyimage.com/200x100/d4d4d4/ffffff" alt="" class="mx-auto d-block"> --}}
                        </div>
                    </div>
                    <div class="row align-items-center justify-content-center align-middle">
                        <div class="col-md-6 col-lg-5">
                            <div class="login-box bg-white box-shadow border-radius-10 shadow">
                                <div class="login-title">
                                    <br>
                                    <h2 class="text-center text-info">Lupa Password</h2>
                                </div>
                                <form method="POST" action="{{ route('password.new.store') }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-12">
                                            <label>Password Baru</label>
                                            <div class="input-group custom">
                                                <input type="password" class="form-control form-control-lg"
                                                    name="password" id="password"/>
                                                <div class="input-group-append custom">
                                                    <span class="input-group-text"><button type="button" id="togglePassword" class="border-0 bg-transparent"><i class="fa-regular fa-eye-slash"></i></button></span>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label>Konfirmasi Password</label>
                                            <div class="input-group custom">
                                                <input type="password" class="form-control form-control-lg"
                                                    name="password_confirmation" id="password2"/>
                                                <div class="input-group-append custom">
                                                    <span class="input-group-text"><button type="button" id="togglePassword2" class="border-0 bg-transparent"><i class="fa-regular fa-eye-slash"></i></button></span>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-group mb-0">
                                                <button type="submit"
                                                    class="btn btn-info btn-lg btn-block">Ubah Password</button>
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
                $(this).html('<i class="fa-regular fa-eye"></i>');
            } else {
                passwordField.attr('type', 'password');
                $(this).html('<i class="fa-regular fa-eye-slash"></i>');
            }
            });
        });

        $(document).ready(function() {
            $('#togglePassword2').click(function() {
                var passwordField = $('#password2');
                var passwordFieldType = passwordField.attr('type');

            // Toggle password field type
            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $(this).html('<i class="fa-regular fa-eye"></i>');
            } else {
                passwordField.attr('type', 'password');
                $(this).html('<i class="fa-regular fa-eye-slash"></i>');
            }
            });
        });
        </script>

            @if ($message = Session::get('errors'))
                swal({
                text: "{{ $message->first() }}",
                type: 'error',
                })
            @endif
        @endsection

@endif
