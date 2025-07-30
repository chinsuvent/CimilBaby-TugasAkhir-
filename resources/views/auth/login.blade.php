<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ci'mil Baby - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/custom.css') }}" rel="stylesheet">

</head>

<body style="background: linear-gradient(135deg, #8B7FB8 0%, #A896C7 100%);">
    <div class="container-fluid p-0">
        <div class="row g-0 min-vh-100">
            <div class="col-12">
                <div class="main-card">
                    <div class="row g-0 h-100">
                        <!-- Left Section -->
                        <div class="col-lg-6 left-section">
                            <div class="decorative-shapes">
                                <div class="shape shape1"></div>
                                <div class="shape shape2"></div>
                            </div>

                            <div class="musical-note">
                                <i class="fas fa-music"></i>
                            </div>

                            <h1 class="welcome-text">
                                Selamat Datang di<br>
                                Ci'mil Baby
                            </h1>

                            <div class="illustration">
                                <img src="{{ asset('admin_assets/img/login.png') }}" alt="Ilustrasi Login" class="img-login">
                            </div>
                        </div>

                        <!-- Right Section -->
                        <div class="col-lg-6 right-section">
                            <div class="form-container">
                                <div class="text-start">
                                    <h1 class="form-title">Masuk</h1>
                                </div>

                                <form action="{{ route('login.action') }}" method="POST" class="user">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ( $errors->all() as $error )
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label class="form-label">Username</label>
                                        <input name="username" type="text" class="form-control form-control-user"
                                            id="exampleInputUsername" aria-describedby="emailHelp"
                                            placeholder="Masukkan username Anda" style="padding: 0.75rem 1rem;" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <div class="password-field">
                                            <input name="password" type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Masukkan password" style="padding: 0.75rem 1rem;" required>
                                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                                <i class="far fa-eye" id="eye-icon"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="text-end mt-1 mb-2">
                                        <a href="{{ url('/wa-lupa-password') }}" class="text-lupa-password">
                                            <small>Lupa Password?</small>
                                        </a>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Masuk
                                    </button>
                                </form>

                                <hr>
                                <div class="register-link">
                                    <a href="{{ route('register') }}">Belum punya akun? <b>Daftar sekarang!</b></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('exampleInputPassword');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Logout Berhasil',
            text: '{{ session('success') }}',
        });
    </script>
    @endif

    @if (session('ubahPassword'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Password Berhasil Diubah!',
            text: '{{ session('success') }}',
        });
    </script>
    @endif

    @if (session('register'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil',
                text: '{{ session('register') }}',
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal, Password atau Username Salah',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
</body>

</html>
