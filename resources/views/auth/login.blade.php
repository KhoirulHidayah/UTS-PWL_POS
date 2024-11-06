<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> <!-- Mengatur encoding karakter menjadi UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Memastikan tampilan responsif -->
    <title>Login Pengguna</title> <!-- Judul halaman -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> <!-- Menggunakan font Google Source Sans Pro -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}"> <!-- Menyertakan ikon Font Awesome -->
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> <!-- Menyertakan styling untuk icheck bootstrap -->
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> <!-- Menyertakan styling untuk SweetAlert2 dengan tema Bootstrap 4 -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}"> <!-- Menyertakan file CSS untuk tema AdminLTE -->
    <style>
        body {
            background-image: url('{{ asset('images/pos.jpg') }}'); /* Gambar latar belakang */
            background-repeat: no-repeat; /* Gambar tidak diulang */
            background-size: cover; /* Gambar menutupi seluruh area */
            background-position: center; /* Gambar diposisikan di tengah */
            height: 100vh; /* Tinggi halaman penuh layar */
        }
        .card {
            background-color: #c0d2f3cc; /* Warna latar belakang kartu dengan sedikit transparansi */
            border-radius: 0.5rem; /* Membuat sudut kartu sedikit melengkung */
        }
        .remember-me {
            font-weight: bold; /* Teks "Remember Me" dibuat tebal */
            margin-top: 10px; /* Menambahkan jarak di atas elemen ini */
        }
        .icheck-primary input[type="checkbox"] {
            width: 20px; /* Mengubah ukuran lebar checkbox */
            height: 20px; /* Mengubah ukuran tinggi checkbox */
            margin-right: 10px; /* Menambahkan jarak di sebelah kanan checkbox */
        }
        /* Custom Checkbox Styles */
        .icheck-primary input[type="checkbox"]:checked {
            background-color: #007bff; /* Warna background checkbox saat dicentang */
            border-color: #007bff; /* Warna border checkbox saat dicentang */
        }
        .icheck-primary input[type="checkbox"]:checked:after {
            color: #dfe3ec; /* Warna tanda centang */
        }
    </style>
</head>
<body class="hold-transition login-page"> <!-- Menggunakan kelas AdminLTE untuk membuat halaman login dengan latar belakang penuh -->
<div class="login-box">
    <div class="card card-outline card-primary"> <!-- Membuat kartu login dengan outline berwarna biru -->
        <div class="card-header text-center">
            <a href="{{ url('/') }}" class="h1"><b>PWL</b>POS</a> <!-- Logo atau nama aplikasi -->
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p> <!-- Pesan di bawah form login -->
            <form action="{{ url('login') }}" method="POST" id="form-login"> <!-- Form login, menggunakan metode POST -->
                @csrf <!-- Token CSRF untuk keamanan -->
                <div class="input-group mb-3"> <!-- Input untuk username dengan icon di samping kanan -->
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username"> <!-- Input username -->
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span> <!-- Icon email (meskipun ini untuk username) -->
                        </div>
                    </div>
                    <small id="error-username" class="error-text text-danger"></small> <!-- Menampilkan pesan error untuk username -->
                </div>
                <div class="input-group mb-3"> <!-- Input untuk password dengan icon di samping kanan -->
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password"> <!-- Input password -->
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span> <!-- Icon kunci untuk password -->
                        </div>
                    </div>
                    <small id="error-password" class="error-text text-danger"></small> <!-- Menampilkan pesan error untuk password -->
                </div>
                <div class="row">
                    <div class="col-8 remember-me">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember"><label for="remember">Remember Me</label> <!-- Checkbox remember me -->
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button> <!-- Tombol submit login -->
                    </div>
                </div>
                <div class="mt-3">
                    <p>Don't have an account? 
                        <a href="{{ url('/register') }}" class="btn btn-primary">Register</a> <!-- Link untuk mendaftar -->
                    </p>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script> <!-- Menyertakan jQuery -->
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> <!-- Menyertakan Bootstrap 4 -->
<!-- jquery-validation -->
<script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script> <!-- Menyertakan plugin jQuery Validation -->
<script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script> <!-- Menyertakan metode tambahan untuk validasi -->
<!-- SweetAlert2 -->
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script> <!-- Menyertakan SweetAlert2 -->
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script> <!-- Menyertakan JavaScript tema AdminLTE -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Mengatur header dengan token CSRF untuk setiap request AJAX
        }
    });
    $(document).ready(function() {
        $("#form-login").validate({
            rules: { // Mengatur aturan validasi untuk input username dan password
                username: {required: true, minlength: 4, maxlength: 20}, // Username harus diisi, minimal 4 karakter dan maksimal 20 karakter
                password: {required: true, minlength: 5, maxlength: 20} // Password harus diisi, minimal 5 karakter dan maksimal 20 karakter
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action, // URL yang akan dituju untuk request login
                    type: form.method, // Metode POST untuk form login
                    data: $(form).serialize(), // Mengirim data form
                    success: function(response) { // Jika login sukses
                        if (response.status) { // Jika status response sukses (true)
                            Swal.fire({
                                icon: 'success', // Tampilkan notifikasi sukses
                                title: 'Berhasil',
                                text: response.message,
                            }).then(function() {
                                window.location = response.redirect; // Redirect ke halaman yang dituju
                            });
                        } else { // Jika login gagal
                            $('.error-text').text(''); // Bersihkan pesan error sebelumnya
                            $.each(response.msgField, function(prefix, val) { // Loop untuk menampilkan pesan error di setiap field
                                $('#error-' + prefix).text(val[0]); // Tampilkan pesan error sesuai fieldnya
                            });
                            Swal.fire({
                                icon: 'error', // Tampilkan notifikasi error
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false; // Cegah form submit default, karena kita menggunakan AJAX
            },
            errorElement: 'span',
            errorPlacement: function(error, element) { // Tempatkan pesan error setelah input field
                error.addClass('invalid-feedback'); // Tambahkan class CSS untuk styling error
                element.closest('.input-group').append(error); // Tempatkan di dalam input-group
            },
            highlight: function(element, errorClass, validClass) { // Tambahkan class is-invalid pada input yang salah
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) { // Hapus class is-invalid jika input sudah benar
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
</body>
</html>
