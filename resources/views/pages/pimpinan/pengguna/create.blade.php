@extends('layouts.admin')

@section('title', 'Pengguna')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Pengguna</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('pimpinan.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Pengguna </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Data Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pimpinan.pengguna.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username"
                                            class="form-control @error('username') is-invalid @enderror"
                                            value="{{ old('username') }}">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="role">Peran Pengguna (Role)</label>
                                        <select class="custom-select @error('role') is-invalid @enderror" name="role">
                                            <option selected>Pilih Peran ...</option>
                                            <option value="admin">Admin</option>
                                            <option value="pimpinan">Pimpinan</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Kata Sandi</label>
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="checkPw"
                                            onclick="lihatPassword()">
                                        <label class="form-check-label" for="checkPw">Lihat Password</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password_repeat">Ulangi Kata Sandi</label>
                                        <input type="password" name="password_repeat" id="password_repeat"
                                            class="form-control @error('password_repeat') is-invalid @enderror"
                                            value="{{ old('password_repeat') }}">
                                        @error('password_repeat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="checkPwr"
                                            onclick="lihatPasswordRepeat()">
                                        <label class="form-check-label" for="checkPwr">Lihat Password</label>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">
                                Tambah
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('tambahStyle')
@endpush

@push('tambahScript')
    <script>
        function lihatPassword() {
            var x = document.getElementById("password");
            var c = document.getElementById("checkPw");
            if (x.type === "password") {
                c.checked = true;
                x.type = "text";
            } else {
                x.type = "password";
                c.checked = false;
            }
        }

        function lihatPasswordRepeat() {
            var x = document.getElementById("password_repeat");
            var c = document.getElementById("checkPwr");
            if (x.type === "password") {
                c.checked = true;
                x.type = "text";
            } else {
                x.type = "password";
                c.checked = false;
            }
        }
    </script>
@endpush
