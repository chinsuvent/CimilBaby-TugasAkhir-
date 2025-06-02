<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" 
    rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('admin_assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            
                            <form action="{{ route('register.save') }}" method="POST" class="user" >
                                @csrf
                                <div class="form-group">
                                    <input name="name" type="text" class="form-control form-control-user @error('name')is-invalid @enderror" id="exampleNamaLengkap"
                                        placeholder="Nama Lengkap">
                                    @error('name')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input name="username" type="text" class="form-control form-control-user @error('username')is-invalid @enderror" id="exampleNamaLengkap"
                                        placeholder="Username">
                                    @error('username')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control form-control-user @error('email')is-invalid @enderror" id="exampleEmail"
                                        placeholder="Email">
                                    @error('email')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input name="no_hp" type="number" class="form-control form-control-user @error('no_hp')is-invalid @enderror" id="exampleNamaLengkap"
                                        placeholder="Nomor Hp">
                                    @error('no_hp')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input name="alamat" type="text" class="form-control form-control-user @error('alamat')is-invalid @enderror" id="exampleNamaLengkap"
                                        placeholder="Alamat">
                                    @error('alamat')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="password" type="password" class="form-control form-control-user @error('password')is-invalid @enderror" id="examplePassword"
                                        placeholder="Password">
                                    @error('username')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="password_confirmation" type="password" class="form-control form-control-user @error('password')is-invalid @enderror" id="exampleRepeatPassword"
                                        placeholder="Repeat Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
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

</body>

</html>