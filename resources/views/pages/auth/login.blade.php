<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">

    <title>Login</title>

    @include('modules.backend.style')
</head>

<body>
    @include('sweetalert::alert')
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card">
                    <div>
                        <div>
                            <a class="logo" href="index.html">
                                <img class="img-fluid for-light"
                                    src="{{ asset('cuba/assets/images/logo/login.png') }}" alt="looginpage">
                                <img class="img-fluid for-dark"
                                    src="{{ asset('cuba/assets/images/logo/logo_dark.png') }}" alt="looginpage">
                            </a>
                        </div>
                        <div class="login-main">
                            <form class="theme-form" action="{{ route('login.proses') }}" method="POST">
                                @csrf
                                <h4>Welcome Back</h4>
                                <div class="form-group">
                                    <label class="col-form-label">Username</label>
                                    <input class="form-control" type="text" name="username" required=""
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="password" name="password" required=""
                                        placeholder="*********">
                                    <div class="show-hide">
                                        <span class="show"> </span>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('modules.backend.script')
    </div>
</body>

</html>
