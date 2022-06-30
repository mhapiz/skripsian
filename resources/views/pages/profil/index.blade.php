@extends('layouts.admin')
@section('title', 'Profilku')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Profilku</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Profilku</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 150px;">Username</th>
                            <td>{{ $data->username }}</td>
                        </tr>
                        <tr>
                            <th style="width: 150px;">Role</th>
                            <td>{{ $data->role }}</td>
                        </tr>
                    </table>
                    <div class="mt-4">

                        <button type="button" class="btn btn-light btn-air-light" data-toggle="modal"
                            data-target="#exampleModal">
                            Edit
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update.my-profile', $data->id_user) }}" method="POST" id="updateForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="{{ $data->username }}">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" class="form-control" name="role" value="{{ $data->role }}" disabled>
                        </div>
                        <div class="accordion" id="accordionExample">
                            <button class="btn btn-light btn-air-light" type="button" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Ganti Kata Sandi
                            </button>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">

                                    <small><span class="text-danger">*</span> Kosongkan kotak input kata sandi
                                        apabila tidak ingin mengganti </small>

                                    <div class="form-group mt-4">
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
                                    {{--  --}}
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
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" form="updateForm">Perbarui</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('tambahStyle')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" />
@endpush

@push('tambahScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "3000",
            "hideDuration": "3000",
            "timeOut": "10000",
            "extendedTimeOut": "10000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    </script>

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
