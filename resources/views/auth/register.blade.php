<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Pengguna</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <style>
        body {
            background-image: url('{{ asset('images/pos.jpg') }}'); /* Ganti dengan path gambar Anda */
            background-repeat: no-repeat; /* Tidak mengulang gambar */
            background-size: cover; /* Menutupi seluruh area */
            background-position: center; /* Memusatkan gambar */
            height: 100vh; /* Mengatur tinggi body */
        }
        .card {
            background-color: rgba(197, 202, 253, 0.8); /* Mengatur latar belakang dengan transparansi */
            border-radius: 0.5rem; /* Menambahkan radius pada sudut */
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ url('/') }}" class="h1"><b>PWL</b>POS</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Register a new account</p>
            <form action="{{ url('register') }}" method="POST" id="form-register">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <small id="error-username" class="error-text text-danger"></small>
                </div>

                <div class="input-group mb-3">
                    <input type="text" id="name" name="nama" class="form-control" placeholder="Name" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-id-card"></span>
                        </div>
                    </div>
                    <small id="error-name" class="error-text text-danger"></small>
                </div>

                <div class="input-group mb-3">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <small id="error-password" class="error-text text-danger"></small>
                </div>

                <div class="input-group mb-3">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <small id="error-password_confirmation" class="error-text text-danger"></small>
                </div>

                <div class="input-group mb-3">
                    <select id="level_id" name="level_id" class="form-control" required>
                        <option value="">Select Level</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->level_id }}">{{ $level->level_nama }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-layer-group"></span>
                        </div>
                    </div>
                    <small id="error-level_id" class="error-text text-danger"></small>
                </div>

                <div class="row">
                    <div class="col-8">
                        <p>Already have an account? <a href="{{ url('/login') }}">Login</a></p>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $("#form-register").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 4,
                    maxlength: 20
                },
                nama: {
                    required: true,
                    minlength: 2,
                    maxlength: 50
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#password'
                },
                level_id: {
                    required: true
                }
            },
            submitHandler: function(form) { 
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        console.log(response); // Log the response for debugging
                        if(response.status) { 
                            Swal.fire({
                                icon: 'success',
                                title: 'Registration Successful',
                                text: response.message,
                            }).then(function() {
                                window.location = response.redirect; // Make sure the response contains 'redirect'
                            });
                        } else { 
                            $('.error-text').text(''); // Clear previous error messages
                            $.each(response.errors, function(key, val) {
                                $('#error-' + key).text(val[0]); // Show validation errors
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Occurred',
                                text: response.message // Make sure response has a 'message'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log error response for debugging
                        Swal.fire({
                            icon: 'error',
                            title: 'Unexpected Error',
                            text: 'Please try again later.'
                        });
                    }
                });
                return false; // Prevent the default form submission
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error); // Append error message to input group
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid'); // Add invalid class to the input
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid'); // Remove invalid class from the input
            }
        });
    });
</script>
</body>
</html>
