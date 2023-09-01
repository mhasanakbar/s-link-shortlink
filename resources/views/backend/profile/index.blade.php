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
                        <h3>Profil Akun</h3>
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mt-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="{{ Auth::user()->username }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" required>
                            </div>
                           
                            <button type="submit" class="btn btn-info">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
