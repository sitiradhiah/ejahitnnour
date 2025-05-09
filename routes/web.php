<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KatelogController;
use App\Http\Controllers\TempahanController;
use App\Http\Controllers\AduanCadanganController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\TestimonialController;

//route sebelum login
Route::get('/', function () {
    return view('index');
});
Route::get('/tentangkami', function () {
    return view('about');
})->name('about');
Route::get('/KatalogUmum', [KatelogController::class, 'KatalogUmum'])->name('KatalogUmum');
Route::get('/hubungi-kami', function () {
    return view('hubungi-kami');
})->name('hubungi.kami');

// LOGIN & LOGOUT Pengguna Berdaftar
Route::prefix('logmasuk')->controller(AuthController::class)->group(function () {
    Route::get('/', 'logmasuk')->name('logmasuk'); // Route untuk view log masuk
    Route::post('/authenticate', 'authenticate')->name('authenticate'); // Proses log masuk
    Route::post('/logout', 'logout')->name('logout'); // Proses log keluar
});

// Route untuk Daftar Pengguna Baru
Route::get('/daftarmasuk', function () {
    return view('daftarmasuk'); // View untuk pendaftaran pengguna baru
});
Route::post('/daftarmasuk', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register'); // Proses pendaftaran

// POST /hubungi-kami - for public form submission
Route::post('/hubungi-kami', [AduanCadanganController::class, 'store'])->name('aduan.store');

// Add all routes that require authentication here
Route::prefix('admin')->middleware(['auth'])->group(function () {

     // Route untuk Dashboard
     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

     // MAKLUMAT SISTEM
     // Senarai Pekerja
    Route::get('pekerja', [WorkerController::class, 'index'])->name('pekerja.index');
    Route::get('pekerja/tambah', [WorkerController::class, 'create'])->name('pekerja.create');
    Route::post('pekerja/tambah', [WorkerController::class, 'store'])->name('pekerja.store');
     // Route untuk mengedit pekerja
     Route::get('pekerja/{id}/edit', [WorkerController::class, 'edit'])->name('pekerja.edit');
     Route::post('pekerja/{id}/update', [WorkerController::class, 'update'])->name('pekerja.update');
     // Route untuk memadam pekerja
     Route::delete('pekerja/{id}', [WorkerController::class, 'destroy'])->name('pekerja.destroy');
 
    // Maklumat Umum - Testimonial
    Route::get('maklumat-sistem/maklumat-umum', [TestimonialController::class, 'index'])->name('testimonial.index');
    Route::get('maklumat-sistem/maklumat-umum/edit/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
    Route::post('maklumat-sistem/maklumat-umum/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');
    Route::post('maklumat-sistem/maklumat-umum/store', [TestimonialController::class, 'store'])->name('testimonial.store');
Route::delete('maklumat-sistem/maklumat-umum/{id}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');

    
    // Katalog (Katalog pakaian, dan sebagainya)
    Route::prefix('katelog')->controller(KatelogController::class)->group(function () {
        Route::get('/', 'index')->name('katelog.senarai');
        Route::post('/store', 'store')->name('katelog.store'); // <-- Ini WAJIB ADA
        Route::get('/{id}/edit', 'edit')->name('katelog.edit');
        Route::post('/update/{id}', 'update')->name('katelog.update');
        Route::delete('/destroy/{id}', 'destroy')->name('katelog.destroy');
    });
    
    // Category Routes
    Route::resource('kategori', CategoryController::class);

    // Custom untuk senarai & borang baru
    Route::get('/tempahan/senarai', [TempahanController::class, 'senarai'])->name('tempahan.senarai');
    Route::get('/tempahan/baru', [TempahanController::class, 'baru'])->name('tempahan.baru');
    Route::get('/tempahan/pelanggan/{id}', [TempahanController::class, 'getPelanggan'])->name('tempahan.getPelanggan');
    Route::resource('tempahan', TempahanController::class)->except(['index', 'create']);
    
    // Lain-lain route
    Route::prefix('janaan-laporan')->middleware(['auth'])->group(function () {
        Route::get('/', function () {
            return view('admin.penjanaan');
        })->name('janaan-laporan.index');
    });

    Route::prefix('aduan-cadangan')->middleware(['auth'])->group(function () {
        // Route for displaying the list of complaints and suggestions (handled by AduanCadanganController)
        Route::get('/', [AduanCadanganController::class, 'index'])->name('aduan-cadangan.index');
        Route::get('/{id}/preview', [AduanCadanganController::class, 'preview'])->name('aduan-cadangan.preview');
        Route::delete('/{id}', [AduanCadanganController::class, 'destroy'])->name('aduan-cadangan.destroy');
    });

    Route::prefix('maklumat-sistem')->middleware(['auth'])->group(function () {
        Route::get('/senarai-pekerja', function () {
            return view('admin.maklumatsistem.senaraipekerja');
        })->name('maklumat-sistem.senarai-pekerja');
    });

});
