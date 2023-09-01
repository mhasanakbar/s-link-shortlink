@extends('templates.admin')
@section('content')
<div class="row mt-10 d-flex align-items-center flex-wrap justify-content-center">
    <div class="col-md-10">
        <div class="card-box mb-30 shadow">
            <div class="pd-20">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/images/Logo2.png') }}" alt="Foto Logo" />
                    </div>
                    <div class="col-md-6">
                        @auth
                        <form action="{{ route('app.link.store') }}" method="POST">
                        @endauth
                        @guest
                        <form action="{{ route('app.link.guest.store') }}" method="POST">
                        @endguest
                        @csrf
                        @method('POST')
                        <h3 class="text-center mt-4 mb-4">Pendekkan URL Anda</h3>
                        <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
                        <div class="input-group mb-3">
                            <input type="url" class="form-control text-center" placeholder="Masukkan URL Anda" name="link[destination]" required>
                            <div class="input-group-append">
                                @auth
                                <button type="submit" class="btn btn-info rounded-start rounded-0" id="button-addon1">Pendekkan</button>
                                @endauth
                                @guest
                                <a href="{{ route('login') }}" class="btn btn-info rounded-start rounded-0" id="button-addon1">Harap Login</a>
                                @endguest
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control text-center" placeholder="https://s-link/xxxxxxx" aria-label="Example text with button addon" readonly id="myInput"
                            @if(request()->has('shorted'))
                            value="{{env('APP_URL')}}{{ request('shorted') }}"
                            @endif
                            >
                            <div class="input-group-append">
                                <button class="btn btn-info rounded-0 rounded-0" type="button" id="copyButton" onclick="myFunction()">Copy</button>
                            </div>
                        </div>
                        @auth
                        </form>
                        @endauth
                    </div>
   

            @guest
                <!-- Modal -->
                <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="loginModalLabel">Login and get your link</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label>Email</label>
                                <div class="input-group custom">
                                    <input type="text" class="form-control form-control-lg" name="email" />
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                    </div>
                                </div>
                                <label>Password</label>
                                <div class="input-group custom">
                                    <input type="password" class="form-control form-control-lg" name="password" id="password"/>
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><button type="button" id="togglePassword" class="border-0 bg-transparent"><i class="fa-regular fa-eye-slash"></i></button></span>
                                        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                    </div>
                                </div>
                                <div class="row pb-30">
                                    <div class="col-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1" />
                                            <label class="custom-control-label" for="customCheck1">Ingat saya</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="forgot-password">
                                            <a href="{{ route('password.forgot') }}" class="text-primary">Lupa Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <p>Belum punya akun? <a href="{{route('register')}}" class="text-primary">Daftar</a></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Sign In</button>
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
                </script>
            @endguest
            @guest
                </form>
            @endguest
        </div>
        <!-- Rounded box for FAQ -->
    
            <h6 class="text-center mt-4 mb-4">Bantuan dan Pertanyaan tentang S-Link</h6>
            <div class="accordion" id="faqAccordion">
                <!-- FAQ 1 -->
                <div class="card">
                    <div class="card-header" id="faqHeading1">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#faqCollapse1"
                                aria-expanded="true" aria-controls="faqCollapse1">
                                Bagaimana cara kerjanya?
                            </button>
                        </h5>
                    </div>

                    <div id="faqCollapse1" class="collapse" aria-labelledby="faqHeading1" data-parent="#faqAccordion">
                        <div class="card-body">
                            <!-- Answer to FAQ 1 -->
                            Layanan Shortlink bekerja dengan mengambil URL yang panjang dan membuat versi yang lebih pendek yang dialihkan ke URL asli saat diakses.
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="card">
                    <div class="card-header" id="faqHeading2">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                Bagaimana cara menggunakannya?
                            </button>
                        </h5>
                    </div>

                    <div id="faqCollapse2" class="collapse" aria-labelledby="faqHeading2" data-parent="#faqAccordion">
                        <div class="card-body">
                            <!-- Answer to FAQ 2 -->
                            Untuk menggunakan layanan Shortlink, cukup tempel URL panjang Anda di kotak input dan klik tombol "Pendekkan". Anda akan menerima URL singkat yang dapat Anda bagikan dengan orang lain.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="card">
                    <div class="card-header" id="faqHeading3">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                Bagaimana cara mengedit URL pendek?
                            </button>
                        </h5>
                    </div>

                    <div id="faqCollapse3" class="collapse" aria-labelledby="faqHeading3" data-parent="#faqAccordion">
                        <div class="card-body">
                            <!-- Answer to FAQ 3 -->
                            Anda dapat mengakses dasbor riwayat. Dari sana, Anda dapat mengedit atau menghapus tautan pendek sesuai kebutuhan.
                        </div>
                    </div>
                </div>
            </div>
        </div>
  

        <script>
        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            
            var tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "Copied: " + copyText.value;
        }
        </script>
                    
{{-- @include('backend.links.create') --}}
@endsection