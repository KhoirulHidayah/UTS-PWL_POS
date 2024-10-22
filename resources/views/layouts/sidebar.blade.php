<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Gradasi Biru</title>
    <link rel="stylesheet" href="path/to/fontawesome.css"> <!-- Ganti dengan path ke fontawesome jika perlu -->
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Ganti dengan path ke bootstrap jika perlu -->
    <style>
        body {
            margin: 0; /* Menghapus margin default pada body */
            padding: 0; /* Menghapus padding default pada body */
            display: flex; /* Menggunakan flexbox untuk penataan */
            min-height: 100vh; /* Memastikan tinggi minimal body sama dengan tinggi viewport */
            flex-direction: column; /* Menyusun elemen dalam kolom */
        }

        .sidebar {
            background: linear-gradient(to bottom, #1e3c72, #2a69ac); /* Gradasi biru */
            width: 250px; /* Lebar sidebar */
            height: 100vh; /* Memastikan sidebar memenuhi tinggi layar */
            overflow-y: auto; /* Jika isi sidebar melebihi tinggi, tambahkan scrollbar */
            flex-shrink: 0; /* Mencegah sidebar menyusut */
        }

        .nav-link {
            color: white; /* Mengubah warna teks link menjadi putih */
        }

        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2); /* Warna latar belakang saat aktif */
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1); /* Efek hover */
            color: #ffffff; /* Mengubah warna teks saat hover */
        }

        .nav-header {
            color: white; /* Mengubah warna teks header menjadi putih */
        }

        footer {
            background-color: #2a69ac; /* Warna latar belakang footer */
            color: white; /* Warna teks footer */
            text-align: center; /* Menyelaraskan teks di tengah */
            padding: 10px; /* Menambahkan padding pada footer */
            width: 100%; /* Memastikan footer memenuhi lebar halaman */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">Data Pengguna</li>

                <li class="nav-item">
                    <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Level User</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/user') }}" class="nav-link {{ ($activeMenu == 'user') ? 'active' : '' }}">
                        <i class="nav-icon far fa-user"></i>
                        <p>Data User</p>
                    </a>
                </li>

                <li class="nav-header">Data Barang</li>

                <li class="nav-item">
                    <a href="{{ url('/kategori') }}" class="nav-link {{ ($activeMenu == 'kategori') ? 'active' : '' }}">
                        <i class="nav-icon far fa-bookmark"></i>
                        <p>Kategori Barang</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/barang') }}" class="nav-link {{ ($activeMenu == 'barang') ? 'active' : '' }}">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>Data Barang</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/supplier') }}" class="nav-link {{ ($activeMenu == 'supplier') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>Data Supplier</p>
                    </a>
                </li>

                <li class="nav-header">Data Transaksi</li>

                <li class="nav-item">
                    <a href="{{ url('/stok') }}" class="nav-link {{ ($activeMenu == 'stok') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>Stok Barang</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/penjualan') }}" class="nav-link {{ ($activeMenu == 'penjualan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>Transaksi Penjualan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/penjualandetail') }}" class="nav-link {{ ($activeMenu == 'penjualanDetail') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Detail Transaksi Penjualan</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <footer>
        © 2024 Sistem Informasi Bisnis
    </footer>

    <!-- Tambahkan script JavaScript jika diperlukan -->
</body>
</html>
