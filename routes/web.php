<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

//Rute untuk user
Route::get('/', [WelcomeController::class, 'index']);
Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
    Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});

Route::delete('/{id}', [UserController::class, 'destroy']);

// Rute untuk Level
Route::get('/level', [LevelController::class, 'index'])->name('level.index'); // Menampilkan daftar level
Route::get('/level/list', [LevelController::class, 'list'])->name('level.list'); // Mengambil data level untuk DataTables (Ajax)
Route::get('/level/create', [LevelController::class, 'create'])->name('level.create'); // Menampilkan form tambah level
Route::post('/level', [LevelController::class, 'store'])->name('level.store'); // Menyimpan data level baru
Route::get('/level/{id}/edit', [LevelController::class, 'edit'])->name('level.edit'); // Menampilkan form edit level
Route::put('/level/{id}', [LevelController::class, 'update'])->name('level.update'); // Menyimpan perubahan data level
Route::delete('/level/{id}', [LevelController::class, 'destroy'])->name('level.destroy'); // Menghapus data level

Route::post('level/list', [LevelController::class, 'list']);
Route::resource('level', LevelController::class);


// Rute untuk Kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index'); // Menampilkan daftar kategori
Route::get('/kategori/list', [KategoriController::class, 'list'])->name('kategori.list'); // Mengambil data kategori untuk DataTables (Ajax)
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create'); // Menampilkan form tambah kategori
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store'); // Menyimpan data kategori baru
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit'); // Menampilkan form edit kategori
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update'); // Menyimpan perubahan data kategori
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy'); // Menghapus data kategori

Route::post('kategori/list', [KategoriController::class, 'list']);
Route::resource('kategori', KategoriController::class);

// Rute untuk Barang
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index'); // Menampilkan daftar barang
Route::get('/barang/list', [BarangController::class, 'list'])->name('barang.list'); // Mengambil data barang untuk DataTables (Ajax)
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create'); // Menampilkan form tambah barang
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store'); // Menyimpan data barang baru
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit'); // Menampilkan form edit barang
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update'); // Menyimpan perubahan data barang
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy'); // Menghapus data barang

// Menggunakan resource route (optional, jika diperlukan)
Route::resource('barang', BarangController::class);
Route::post('barang/list', [BarangController::class, 'list']);

// Rute untuk Supplier
Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index'); // Menampilkan daftar supplier
Route::get('/supplier/list', [SupplierController::class, 'list'])->name('supplier.list'); // Mengambil data supplier untuk DataTables (Ajax)
Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create'); // Menampilkan form tambah supplier
Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store'); // Menyimpan data supplier baru
Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit'); // Menampilkan form edit supplier
Route::put('/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update'); // Menyimpan perubahan data supplier
Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy'); // Menghapus data supplier

// Menggunakan resource route (optional, jika diperlukan)
Route::resource('supplier', SupplierController::class);
Route::post('supplier/list', [SupplierController::class, 'list']);

