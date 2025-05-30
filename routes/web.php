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
use App\Http\Controllers\PelangganController;

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
    Route::controller(WorkerController::class)->prefix('maklumat-sistem')->group(function () {
        Route::get('/senarai-pekerja', 'index')->name('maklumat-sistem.senarai-pekerja');
        Route::get('/pekerja/tambah', 'create')->name('pekerja.create');
        Route::post('/pekerja/tambah', 'store')->name('pekerja.store');
        Route::get('/pekerja/{id}/edit', 'edit')->name('pekerja.edit');
        Route::post('/pekerja/{id}/update', 'update')->name('pekerja.update');
        Route::delete('/pekerja/{id}', 'destroy')->name('pekerja.destroy');
    });

    // Maklumat Umum - Testimonial
    Route::controller(TestimonialController::class)->prefix('maklumat-sistem/maklumat-umum')->group(function () {
        Route::get('/', 'index')->name('testimonial.index');
        Route::post('/store', 'store')->name('testimonial.store');
        Route::get('/edit/{id}', 'edit')->name('testimonial.edit');
        Route::post('/{id}', 'update')->name('testimonial.update');
        Route::delete('/{id}', 'destroy')->name('testimonial.destroy');
    });

    // Maklumat Umum - Pelanggan
    Route::controller(PelangganController::class)->prefix('maklumat-sistem')->group(function () {
        Route::get('senarai-pelanggan', 'index')->name('pelanggan.index');
        // Route::get('pelanggan/tambah', 'create')->name('pelanggan.create');
        // Route::post('pelanggan/tambah', 'store')->name('pelanggan.store');
        // Route::get('pelanggan/{id}/edit', 'edit')->name('pelanggan.edit');
        // Route::post('pelanggan/{id}/update', 'update')->name('pelanggan.update');
        // Route::delete('pelanggan/{id}', 'destroy')->name('pelanggan.destroy');
        // Route untuk mengemaskini status pelanggan
    });

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
    // Route::get('/tempahan/senarai', [TempahanController::class, 'senarai'])->name('tempahan.senarai');
    // Route::get('/tempahan/baru', [TempahanController::class, 'baru'])->name('tempahan.baru');
    // Route::get('/tempahan/pelanggan/{id}', [TempahanController::class, 'getPelanggan']);
    // Route::resource('tempahan', TempahanController::class)->except(['index', 'create']);
    // Route untuk semakan pesanan di dashboard (untuk pengguna log masuk)
    Route::prefix('tempahan')->name('tempahan.')->group(function () {
        Route::get('/senarai', [TempahanController::class, 'senarai'])->name('senarai');
        Route::get('/baru', [TempahanController::class, 'baru'])->name('baru');
        Route::get('/edit', [TempahanController::class, 'edit'])->name('edit');
        Route::get('/pelanggan/{id}', [TempahanController::class, 'getPelanggan'])->name('pelanggan');

        Route::resource('/', TempahanController::class)->except(['index', 'create']);
    });
    Route::get('/dashboard/semakan-pesanan', [TempahanController::class, 'semakanPesananDashboard'])->name('semakan-pesanan.dashboard');

    // Route untuk semakan pesanan di index (untuk pengguna tidak log masuk)
    Route::get('/semakan-pesanan', [TempahanController::class, 'semakanPesanan'])->name('semakan-pesanan');

    // Tambahkan route untuk mengemaskini status tempahan
    Route::patch('/tempahan/{id}/status', [TempahanController::class, 'updateStatus'])->name('tempahan.update.status');


    // Lain-lain route
    Route::prefix('janaan-laporan')->middleware(['auth'])->group(function () {
        Route::get('/', function () {
            return view('admin.penjanaan');
        })->name('janaan-laporan.index');
    });

    Route::prefix('aduan-cadangan')->middleware(['auth'])->group(function () {
        // Route for displaying the list of complaints and suggestions (handled by AduanCadanganController)
        Route::get('/', [AduanCadanganController::class, 'index'])->name('aduan-cadangan.index');
        
        // Route for previewing a specific complaint or suggestion
        Route::get('/{id}/preview', [AduanCadanganController::class, 'preview'])->name('aduan-cadangan.preview');
        
        // Route for deleting a specific complaint or suggestion
        Route::delete('/{id}', [AduanCadanganController::class, 'destroy'])->name('aduan-cadangan.destroy');
        
        // Route for marking a complaint or suggestion as read (Dibaca)
        Route::post('/{id}/read', [AduanCadanganController::class, 'markAsRead'])->name('aduan-cadangan.read');
    });
    

    

});
