<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PenjualanDetailController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/user', [UserController::class, 'index']);
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::pattern('id', '[0-9]+');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::middleware(['auth'])->group(function(){
        // Rute untuk halaman update profile
        Route::get('/profile/update', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        
        // Rute untuk halaman update password
        Route::get('/password/update', [PasswordController::class, 'edit'])->name('password.edit');
        Route::post('/password/update', [PasswordController::class, 'update'])->name('password.update');
   
        //Rute untuk halaman update data diri
        Route::get('user_profile/updatedatadiri', [UserProfileController::class, 'updateDataDiri'])->name('user_profile.updateDataDiri');
        Route::post('user_profile/updatedatadiri', [UserProfileController::class, 'storeUpdateDataDiri'])->name('user_profile.storeUpdateDataDiri');


        Route::get('/', [WelcomeController::class, 'index']);

        Route::middleware(['authorize:ADM'])->group(function () {
            Route::get('/user', [UserController::class, 'index']);          // menampilkan halaman awal user
            Route::post('/user/list', [UserController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
            Route::get('/user/create', [UserController::class, 'create']);   // menampilkan halaman form tambah user
            Route::post('/user', [UserController::class, 'store']);         // menyimpan data user baru
            Route::get('/user/create_ajax', [UserController::class, 'create_ajax']);   // menampilkan halaman form tambah user
            Route::post('/user/ajax', [UserController::class, 'store_ajax']);         // menyimpan data user baru
            Route::get('/user/import', [UserController::class, 'import']);
            Route::post('/user/import_ajax', [UserController::class, 'import_ajax']);
            Route::get('/user/export_excel', [UserController::class, 'export_excel']); // export excel
            Route::get('/user/export_pdf', [UserController::class, 'export_pdf']);
            Route::get('/user/{id}', [UserController::class, 'show']);       // menampilkan detail user
            Route::get('/user/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
            Route::put('/user/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
            Route::get('/user/{id}/edit_ajax', [UserController::class, 'edit_ajax']);  // menampilkan halaman form edit user
            Route::put('/user/{id}/update_ajax', [UserController::class, 'update_ajax']);     // menyimpan perubahan data user
            Route::get('/user/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);     // menyimpan perubahan data user
            Route::delete('/user/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user
            Route::delete('/user/{id}', [UserController::class, 'destroy']); // menghapus data user
        });
    
        // Route::group(['prefix' => 'level'], function () {
        Route::middleware(['authorize:ADM'])->group(function () {
            Route::get('/level', [LevelController::class, 'index']);          // menampilkan halaman awal level
            Route::post('/level/list', [LevelController::class, 'list']);      // menampilkan data level dalam bentuk json untuk datatables
            Route::get('/level/create', [LevelController::class, 'create']);   // menampilkan halaman form tambah level
            Route::get('/level/create_ajax', [LevelController::class, 'create_ajax']);
            Route::post('/level', [LevelController::class, 'store']);         // menyimpan data level baru
            Route::post('/level/ajax', [LevelController::class, 'store_ajax']);
            Route::get('/level/import', [LevelController::class, 'import']);
            Route::post('/level/import_ajax', [LevelController::class, 'import_ajax']);
            Route::get('/level/export_excel', [LevelController::class, 'export_excel']); // export excel
            Route::get('/level/export_pdf', [LevelController::class, 'export_pdf']); // export pdf
            Route::get('/level/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
            Route::put('/level/{id}/update_ajax', [LevelController::class, 'update_ajax']);
            Route::get('/level/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
            Route::delete('/level/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
            Route::get('/level/{id}', [LevelController::class, 'show']);       // menampilkan detail level
            Route::get('/level/{id}/edit', [LevelController::class, 'edit']);  // menampilkan halaman form edit level
            Route::put('/level/{id}', [LevelController::class, 'update']);     // menyimpan perubahan data level
            Route::delete('/level/{id}', [LevelController::class, 'destroy']); // menghapus data level
        });
    
        // Route::group(['prefix' => 'kategori'], function () {
        Route::middleware(['authorize:ADM,MNG'])->group(function () {
            Route::get('/kategori', [KategoriController::class, 'index']);          // menampilkan halaman awal kategori
            Route::post('/kategori/list', [KategoriController::class, 'list']);      // menampilkan data kategori dalam bentuk json untuk datatables
            Route::get('/kategori/create', [KategoriController::class, 'create']);   // menampilkan halaman form tambah kategori
            Route::get('/kategori/create_ajax', [KategoriController::class, 'create_ajax']);
            Route::post('/kategori/ajax', [KategoriController::class, 'store_ajax']);
            Route::post('/kategori', [KategoriController::class, 'store']);         // menyimpan data kategori baru
            Route::get('/kategori/import', [KategoriController::class, 'import']);
            Route::post('/kategori/import_ajax', [KategoriController::class, 'import_ajax']);
            Route::get('/kategori/export_excel', [KategoriController::class, 'export_excel']); // export excel
            Route::get('/kategori/export_pdf', [KategoriController::class, 'export_pdf']); // export pdf
            Route::get('/kategori/{id}', [KategoriController::class, 'show']);       // menampilkan detail kategori
            Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);  // menampilkan halaman form edit kategori
            Route::put('/kategori/{id}', [KategoriController::class, 'update']);     // menyimpan perubahan data kategori
            Route::get('/kategori/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);
            Route::put('/kategori/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
            Route::get('/kategori/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
            Route::delete('/kategori/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
            Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']); // menghapus data kategori
        });
    
        // Route::group(['prefix' => 'barang'], function () {
        Route::middleware(['authorize:ADM,MNG,STF,CUS'])->group(function () {
            Route::get('/barang', [BarangController::class, 'index']);          // menampilkan halaman awal barang
            Route::post('/barang/list', [BarangController::class, 'list']);      // menampilkan data barang dalam bentuk json untuk datatables
            Route::get('/barang/create', [BarangController::class, 'create']);   // menampilkan halaman form tambah barang
            Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']);
            Route::post('/barang', [BarangController::class, 'store']);         // menyimpan data barang baru
            Route::get('/barang/import', [BarangController::class, 'import']);
            Route::post('/barang/import_ajax', [BarangController::class, 'import_ajax']);
            Route::get('/barang/export_excel', [BarangController::class, 'export_excel']); // export excel
            Route::get('/barang/export_pdf', [BarangController::class, 'export_pdf']); // export pdf
            Route::post('/barang/ajax', [BarangController::class, 'store_ajax']);
            Route::get('/barang/{id}', [BarangController::class, 'show']);       // menampilkan detail barang
            Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);  // menampilkan halaman form edit barang
            Route::put('/barang/{id}', [BarangController::class, 'update']);     // menyimpan perubahan data barang
            Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax'])->name('barang.edit_ajax');
            Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax'])->name('barang.edit_ajax');
            Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax'])->name('barang.delete_ajax');
            Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax'])->name('barang.delete_ajax');
            Route::delete('/barang/{id}', [BarangController::class, 'destroy']); // menghapus data barang
        });
    
        // Route::group(['prefix' => 'supplier'], function () {
        Route::middleware(['authorize:ADM,MNG'])->group(function () {
            Route::get('/supplier', [SupplierController::class, 'index']);          // menampilkan halaman awal supplier
            Route::post('/supplier/list', [SupplierController::class, 'list']);      // menampilkan data supplier dalam bentuk json untuk datatables
            Route::get('/supplier/create', [SupplierController::class, 'create']);   // menampilkan halaman form tambah supplier
            Route::get('/supplier/create_ajax', [SupplierController::class, 'create_ajax']);
            Route::post('/supplier', [SupplierController::class, 'store']);         // menyimpan data supplier baru
            Route::post('/supplier/ajax', [SupplierController::class, 'store_ajax']);
            Route::get('/supplier/import', [SupplierController::class, 'import']);
            Route::post('/supplier/import_ajax', [SupplierController::class, 'import_ajax']);
            Route::get('/supplier/export_excel', [SupplierController::class, 'export_excel']); // export excel
            Route::get('/supplier/export_pdf', [SupplierController::class, 'export_pdf']); // export pdf
            Route::get('/supplier/{id}', [SupplierController::class, 'show']);       // menampilkan detail supplier
            Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit']);  // menampilkan halaman form edit supplier
            Route::put('/supplier/{id}', [SupplierController::class, 'update']);     // menyimpan perubahan data supplier
            Route::get('/supplier/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);
            Route::put('/supplier/{id}/update_ajax', [SupplierController::class, 'update_ajax']);
            Route::get('/supplier/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);
            Route::delete('/supplier/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);
            Route::delete('/supplier/{id}', [SupplierController::class, 'destroy']); // menghapus data supplier
        });
    
        // Route::group(['prefix' => 'stok'], function () {
        Route::middleware(['authorize:ADM,MNG,STF,CUS'])->group(function () {
            Route::get('/stok', [StokController::class, 'index']);          // menampilkan halaman awal stok
            Route::post('/stok/list', [StokController::class, 'list']);      // menampilkan data stok dalam bentuk json untuk datatables
            Route::get('/stok/create', [StokController::class, 'create']);   // menampilkan halaman form tambah stok
            Route::get('/stok/create_ajax', [StokController::class, 'create_ajax']);
            Route::post('/stok/ajax', [StokController::class, 'store_ajax']);
            Route::post('/stok', [StokController::class, 'store']);         // menyimpan data stok baru
            Route::get('/stok/{id}', [StokController::class, 'show']);       // menampilkan detail stok
            Route::get('/stok/{id}/edit', [StokController::class, 'edit']);  // menampilkan halaman form edit stok
            Route::put('/stok/{id}', [StokController::class, 'update']);     // menyimpan perubahan data stok
            Route::get('/stok/{id}/edit_ajax', [StokController::class, 'edit_ajax']);
            Route::put('/stok/{id}/update_ajax', [StokController::class, 'update_ajax']);
            Route::get('/stok/{id}/delete_ajax', [StokController::class, 'confirm_ajax']);
            Route::delete('/stok/{id}/delete_ajax', [StokController::class, 'delete_ajax']);
            Route::delete('/stok/{id}', [StokController::class, 'destroy']); // menghapus data stok
            Route::get('/stok/import', [StokController::class, 'import'])->name('stok.import');
            Route::post('/stok/import_ajax', [StokController::class, 'importAjax'])->name('stok.import.ajax');
            Route::get('/stok/export_excel', [StokController::class, 'export_excel']); // export excel
            Route::get('/stok/export_pdf', [StokController::class, 'export_pdf']); // export pdf
        });

        Route::middleware(['authorize:ADM,MNG,STF,CUS'])->group(function () {
            Route::prefix('penjualan')->group(function () {
                Route::get('/', [PenjualanController::class, 'index']);            // menampilkan halaman awal penjualan
                Route::post('/list', [PenjualanController::class, 'list']);        // menampilkan data penjualan dalam bentuk json untuk datatables
                Route::get('/create', [PenjualanController::class, 'create']);     // menampilkan halaman form tambah penjualan
                Route::get('/create_ajax', [PenjualanController::class, 'create_ajax']);
                Route::post('/', [PenjualanController::class, 'store']);           // menyimpan data penjualan baru
                Route::get('/{id}', [PenjualanController::class, 'show']);         // menampilkan detail penjualan
                Route::get('/{id}/edit', [PenjualanController::class, 'edit']);    // menampilkan halaman form edit penjualan
                Route::put('/{id}', [PenjualanController::class, 'update']);       // menyimpan perubahan data penjualan
                Route::get('/{id}/edit_ajax', [PenjualanController::class, 'edit_ajax']); // menampilkan halaman form edit penjualan Ajax
                Route::put('/{id}/update_ajax', [PenjualanController::class, 'update_ajax']); // menyimpan perubahan penjualan melalui Ajax
                Route::get('/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax']); // tampilan konfirmasi hapus penjualan
                Route::delete('/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax']); // menghapus data penjualan melalui Ajax
                Route::delete('/{id}', [PenjualanController::class, 'destroy']);   // menghapus data penjualan
                Route::get('/import', [PenjualanController::class, 'import'])->name('penjualan.import');
                Route::post('/import_ajax', [PenjualanController::class, 'import_ajax'])->name('penjualan.import.ajax');
                Route::get('/export_excel', [PenjualanController::class, 'export_excel']); // export excel
                Route::get('/export_pdf', [PenjualanController::class, 'export_pdf']); // export pdf
                Route::get('/show_ajax', [PenjualanController::class, 'export_pdf']); // export pdf
            });
        });

        Route::middleware(['authorize:ADM,MNG,STF,CUS'])->group(function () {
            Route::prefix('penjualandetail')->group(function () {
                Route::get('/', [PenjualanDetailController::class, 'index']);            // Menampilkan halaman awal detail penjualan
                Route::post('/list', [PenjualanDetailController::class, 'list']);        // Menampilkan data detail penjualan dalam bentuk JSON untuk DataTables
                Route::get('/create', [PenjualanDetailController::class, 'create']);     // Menampilkan halaman form tambah detail penjualan
                Route::get('/create_ajax', [PenjualanDetailController::class, 'create_ajax']);
                Route::post('/', [PenjualanDetailController::class, 'store']);           // Menyimpan data detail penjualan baru
                Route::get('/{id}', [PenjualanDetailController::class, 'show']);         // Menampilkan detail penjualan
                Route::get('/{id}/edit', [PenjualanDetailController::class, 'edit']);    // Menampilkan halaman form edit detail penjualan
                Route::put('/{id}', [PenjualanDetailController::class, 'update']);       // Menyimpan perubahan data detail penjualan
                Route::get('/{id}/edit_ajax', [PenjualanDetailController::class, 'edit_ajax']); // Menampilkan halaman form edit detail penjualan Ajax
                Route::put('/{id}/update_ajax', [PenjualanDetailController::class, 'update_ajax']); // Menyimpan perubahan detail penjualan melalui Ajax
                Route::get('/{id}/delete_ajax', [PenjualanDetailController::class, 'confirm_ajax']); // Tampilan konfirmasi hapus detail penjualan
                Route::delete('/{id}/delete_ajax', [PenjualanDetailController::class, 'delete_ajax']); // Menghapus data detail penjualan melalui Ajax
                Route::delete('/{id}', [PenjualanDetailController::class, 'destroy']);   // Menghapus data detail penjualan
                Route::get('/import', [PenjualanDetailController::class, 'import'])->name('penjualandetail.import');
                Route::post('/import_ajax', [PenjualanDetailController::class, 'import_ajax'])->name('penjualandetail.import.ajax');
                Route::get('/export_excel', [PenjualanDetailController::class, 'export_excel']); // export excel
                Route::get('/export_pdf', [PenjualanDetailController::class, 'export_pdf']); // export pdf
            });
        });
        
   
    });