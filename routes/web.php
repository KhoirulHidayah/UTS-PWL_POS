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
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']); // menyimpan data user baru Ajax
    Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user Ajax
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); //Untuk tampilan confirm delete Ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); //Untuk delete Ajax
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});

Route::delete('/{id}', [UserController::class, 'destroy']);

// Rute untuk Level
/*Route::get('/level', [LevelController::class, 'index'])->name('level.index'); // Menampilkan daftar level
Route::get('/level/list', [LevelController::class, 'list'])->name('level.list'); // Mengambil data level untuk DataTables (Ajax)
Route::get('/level/create', [LevelController::class, 'create'])->name('level.create'); // Menampilkan form tambah level
Route::post('/level', [LevelController::class, 'store'])->name('level.store'); // Menyimpan data level baru
Route::get('/level/{id}/edit', [LevelController::class, 'edit'])->name('level.edit'); // Menampilkan form edit level
Route::put('/level/{id}', [LevelController::class, 'update'])->name('level.update'); // Menyimpan perubahan data level
Route::delete('/level/{id}', [LevelController::class, 'destroy'])->name('level.destroy'); // Menghapus data level

Route::post('level/list', [LevelController::class, 'list']);
Route::resource('level', LevelController::class);*/

// Rute untuk Level (diperbarui)
Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index'])->name('level.index'); // Menampilkan daftar level
    Route::post('/list', [LevelController::class, 'list'])->name('level.list'); // Mengambil data level untuk DataTables (Ajax)
    Route::get('/create_ajax', [LevelController::class, 'create_ajax'])->name('level.create_ajax'); // Menampilkan form tambah level Ajax
    Route::post('/ajax', [LevelController::class, 'store_ajax'])->name('level.store_ajax'); // Menyimpan data level baru Ajax
    Route::get('/{id}', [LevelController::class, 'show'])->name('level.show'); // Menampilkan detail level Ajax
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax'])->name('level.edit_ajax'); // Menampilkan form edit level Ajax
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax'])->name('level.update_ajax'); // Menyimpan perubahan data level Ajax
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax'])->name('level.confirm_ajax'); // Untuk tampilan confirm delete Ajax
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax'])->name('level.delete_ajax'); // Untuk delete Ajax
    Route::delete('/{id}', [LevelController::class, 'destroy'])->name('level.destroy'); // Menghapus data level
});

// Rute untuk Kategori
/*Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index'); // Menampilkan daftar kategori
Route::get('/kategori/list', [KategoriController::class, 'list'])->name('kategori.list'); // Mengambil data kategori untuk DataTables (Ajax)
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create'); // Menampilkan form tambah kategori
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store'); // Menyimpan data kategori baru
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit'); // Menampilkan form edit kategori
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update'); // Menyimpan perubahan data kategori
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy'); // Menghapus data kategori

Route::post('kategori/list', [KategoriController::class, 'list']);
Route::resource('kategori', KategoriController::class);*/

// Rute untuk Kategori
Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index'])->name('kategori.index'); // Menampilkan daftar kategori
    Route::post('/list', [KategoriController::class, 'list'])->name('kategori.list'); // Mengambil data kategori untuk DataTables (Ajax)
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax'])->name('kategori.create_ajax'); // Menampilkan form tambah kategori Ajax
    Route::post('/ajax', [KategoriController::class, 'store_ajax'])->name('kategori.store_ajax'); // Menyimpan data kategori baru Ajax
    Route::get('/{id}', [KategoriController::class, 'show'])->name('kategori.show'); // Menampilkan detail kategori Ajax
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax'])->name('kategori.edit_ajax'); // Menampilkan form edit kategori Ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax'])->name('kategori.update_ajax'); // Menyimpan perubahan data kategori Ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax'])->name('kategori.confirm_ajax'); // Untuk tampilan confirm delete Ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax'])->name('kategori.delete_ajax'); // Untuk delete Ajax
    Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy'); // Menghapus data kategori
});

// Rute untuk Barang
/*Route::get('/barang', [BarangController::class, 'index'])->name('barang.index'); // Menampilkan daftar barang
Route::get('/barang/list', [BarangController::class, 'list'])->name('barang.list'); // Mengambil data barang untuk DataTables (Ajax)
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create'); // Menampilkan form tambah barang
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store'); // Menyimpan data barang baru
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit'); // Menampilkan form edit barang
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update'); // Menyimpan perubahan data barang
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy'); // Menghapus data barang

// Menggunakan resource route (optional, jika diperlukan)
Route::resource('barang', BarangController::class);
Route::post('barang/list', [BarangController::class, 'list']);*/

// Rute untuk Barang
Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index'])->name('barang.index'); // Menampilkan daftar barang
    Route::post('/list', [BarangController::class, 'list'])->name('barang.list'); // Mengambil data barang untuk DataTables (Ajax)
    Route::get('/create_ajax', [BarangController::class, 'create_ajax'])->name('barang.create_ajax'); // Menampilkan form tambah barang Ajax
    Route::post('/ajax', [BarangController::class, 'store_ajax'])->name('barang.store_ajax'); // Menyimpan data barang baru Ajax
    Route::get('/{id}', [BarangController::class, 'show'])->name('barang.show'); // Menampilkan detail barang Ajax
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax'])->name('barang.edit_ajax'); // Menampilkan form edit barang Ajax
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax'])->name('barang.update_ajax'); // Menyimpan perubahan data barang Ajax
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax'])->name('barang.confirm_ajax'); // Untuk tampilan konfirmasi hapus barang Ajax
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax'])->name('barang.delete_ajax'); // Untuk hapus barang Ajax
    Route::delete('/{id}', [BarangController::class, 'destroy'])->name('barang.destroy'); // Menghapus data barang
});


// Rute untuk Supplier
/*Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index'); // Menampilkan daftar supplier
Route::get('/supplier/list', [SupplierController::class, 'list'])->name('supplier.list'); // Mengambil data supplier untuk DataTables (Ajax)
Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create'); // Menampilkan form tambah supplier
Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store'); // Menyimpan data supplier baru
Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit'); // Menampilkan form edit supplier
Route::put('/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update'); // Menyimpan perubahan data supplier
Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy'); // Menghapus data supplier

// Menggunakan resource route (optional, jika diperlukan)
Route::resource('supplier', SupplierController::class);
Route::post('supplier/list', [SupplierController::class, 'list']);*/

// Rute untuk Supplier
Route::group(['prefix' => 'supplier'], function () {
    Route::get('/', [SupplierController::class, 'index'])->name('supplier.index'); // Menampilkan daftar supplier
    Route::post('/list', [SupplierController::class, 'list'])->name('supplier.list'); // Mengambil data supplier untuk DataTables (Ajax)
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax'])->name('supplier.create_ajax'); // Menampilkan form tambah supplier Ajax
    Route::post('/ajax', [SupplierController::class, 'store_ajax'])->name('supplier.store_ajax'); // Menyimpan data supplier baru Ajax
    Route::get('/{id}', [SupplierController::class, 'show'])->name('supplier.show'); // Menampilkan detail supplier Ajax
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax'])->name('supplier.edit_ajax'); // Menampilkan form edit supplier Ajax
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax'])->name('supplier.update_ajax'); // Menyimpan perubahan data supplier Ajax
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax'])->name('supplier.confirm_ajax'); // Untuk tampilan konfirmasi hapus supplier Ajax
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax'])->name('supplier.delete_ajax'); // Untuk hapus supplier Ajax
    Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy'); // Menghapus data supplier
});


