<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ci'mil Baby - Register</title>

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
                                    <h1 class="form-title" style="margin-bottom: 1.5rem;">Buat Akun</h1>
                                </div>

                                <form action="{{ route('register.save') }}" method="POST" class="user">
                                    @csrf

                                    <div class="form-group">
                                        <input name="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" placeholder="Nama Lengkap" style="padding: 0.75rem 1rem;">
                                        @error('name')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input name="username" type="text" class="form-control form-control-user @error('username') is-invalid @enderror" placeholder="Username" style="padding: 0.75rem 1rem;">
                                        @error('username')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Email" style="padding: 0.75rem 1rem;">
                                        @error('email')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- <div class="form-group">
                                        <input name="no_hp" type="number" class="form-control form-control-user @error('no_hp') is-invalid @enderror" placeholder="Nomor HP" style="padding: 0.75rem 1rem;">
                                        @error('no_hp')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input name="alamat" type="text" class="form-control form-control-user @error('alamat') is-invalid @enderror" placeholder="Alamat" style="padding: 0.75rem 1rem;">
                                        @error('alamat')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div> --}}

                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Password" style="padding: 0.75rem 1rem;" id="exampleInputPassword">
                                        @error('password')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                     <hr>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Daftar
                                    </button>
                                </form>




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
            confirmButtonColor: '#8B7FB8',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    @if (session('register'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil',
                text: '{{ session('register') }}',
                confirmButtonColor: '#8B7FB8',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

</body>

</html>
