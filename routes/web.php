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
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TempahanLaporanController;
use App\Http\Controllers\EmailSettingController;

use Illuminate\Support\Facades\Mail;
// Route untuk menghantar email ujian
    // Pastikan anda telah mengkonfigurasi mail di .env
    Route::get('/test-email', function () {
        try {
            Mail::raw('Ini adalah ujian penghantaran email dari Laman Web Rasmi Kedai Jahit N\'NOUR.', function ($message) {
                $message->to('sitiradhiahmegat@gmail.com') // Gantikan dengan alamat email penerima
                        ->subject('Ujian Email Laravel');
            });
            return 'Email telah dihantar!';
        } catch (\Exception $e) {
            return 'Gagal menghantar email: ' . $e->getMessage();
        }
    });

//route sebelum login
Route::get('/', function () {
    return view('index');
});
Route::post('/pra-tempahan/submit', [TempahanController::class, 'praTempahanSubmit'])->name('pra-tempahan.submit');
Route::get('/get-designs-by-kategori', [TempahanController::class, 'getDesignsByKategori']);


Route::get('/tentangkami', function () {
    return view('about');
})->name('about');
Route::get('/KatalogUmum', [KatelogController::class, 'KatalogUmum'])->name('KatalogUmum');
Route::get('/hubungi-kami', function () {
    return view('hubungi-kami');
})->name('hubungi.kami');
// Untuk pengguna awam (tanpa login)
Route::get('/semakan-pesanan', [TempahanController::class, 'semakanPesanan'])->name('semakan-pesanan');

// LOGIN & LOGOUT Pengguna Berdaftar
Route::prefix('logmasuk')->controller(AuthController::class)->group(function () {
    Route::get('/', 'logmasuk')->name('logmasuk'); // Route untuk view log masuk
    Route::post('/authenticate', 'authenticate')->name('authenticate'); // Proses log masuk
    Route::post('/logout', 'logout')->name('logout'); // Proses log keluar
});

// Route untuk Daftar Pengguna Baru
Route::controller(RegisterController::class)->prefix('daftarmasuk')->group(function () {
    Route::get('/', 'showRegistrationForm')->name('register'); // View untuk pendaftaran pengguna baru
    Route::post('/', 'register')->name('register.create'); // Proses pendaftaran
});

// Route untuk Daftar Pengguna Baru
// Route::get('/daftarmasuk', function () {
//     return view('daftarmasuk'); // View untuk pendaftaran pengguna baru
// });

// Route::post('/daftarmasuk', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
// Proses pendaftaran

// POST /hubungi-kami - for public form submission
Route::post('/hubungi-kami', [AduanCadanganController::class, 'store'])->name('aduan.store');

// Add all routes that require authentication here
Route::prefix('admin')->middleware(['auth', 'checkUserStatus'])->group(function () {

    // Route untuk Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

     // MAKLUMAT SISTEM
     // Senarai Pekerja
    Route::controller(WorkerController::class)->prefix('maklumat-sistem')->group(function () {
        Route::get('/senarai-pekerja', 'index')->name('senarai-pekerja.index');
        Route::get('/senarai-pekerja/tambah', 'create')->name('senarai-pekerja.create');
        Route::post('/senarai-pekerja/tambah', 'store')->name('senarai-pekerja.store');
        Route::patch('/senarai-pekerja/{id}/toggle-disahkan', [WorkerController::class, 'toggleDisahkan'])->name('toggleDisahkan');
        Route::get('/senarai-pekerja/{id}/edit', 'edit')->name('senarai-pekerja.edit');
        Route::put('/senarai-pekerja/{id}/update', 'update')->name('senarai-pekerja.update');
        Route::delete('/senarai-pekerja/{id}', 'destroy')->name('senarai-pekerja.destroy');
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
        Route::get('senarai-pelangga/{id}/edit', 'edit')->name('pelanggan.edit');
        Route::put('senarai-pelangga/{id}/update', 'update')->name('pelanggan.update');
        Route::delete('senarai-pelanggan/{id}', 'destroy')->name('pelanggan.destroy');
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
        Route::get('/pelanggan/{id}', [TempahanController::class, 'getPelanggan'])->name('pelanggan');

        // Route edit, update, destroy — penting untuk 'Kemaskini' & 'Padam'
        Route::get('/{id}/edit', [TempahanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TempahanController::class, 'update'])->name('update');
        Route::delete('/{id}', [TempahanController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/hantar-status', [TempahanController::class, 'hantarStatusTempahan'])->name('hantarStatus');

        // Store untuk tempahan baru
        Route::post('/', [TempahanController::class, 'store'])->name('store');
    });

    // ******LAPORAN TEMPAHAN******
    Route::prefix('tempahan')->controller(TempahanLaporanController::class)->name('tempahan.laporan.')->group(function () {
        Route::get('/laporan-tempahan', 'index')->name('senarai');
        Route::post('/laporan-tempahan', 'filter')->name('filter');
        Route::get('/laporan-tempahan/{id}', 'show')->name('pdf');
    });

    // Route untuk semakan pesanan di dashboard (untuk pengguna log masuk)
    Route::get('/dashboard/semakan-pesanan', [TempahanController::class, 'semakanPesananDashboard'])->name('semakan-pesanan.dashboard');


    // Tambahkan route untuk mengemaskini status tempahan
    Route::patch('/tempahan/{id}/status', [TempahanController::class, 'updateStatus'])->name('tempahan.update.status');

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

    Route::get('/tetapan', [App\Http\Controllers\TetapanController::class, 'index'])->name('tetapan.index');

    Route::prefix('tetapan')->name('tetapan.')->group(function () {
        // Kedai (shop info) routes
        // Route::get('/maklumat-kedai', [KedaiController::class, 'index'])->name('kedai.index');
        // Route::post('/maklumat-kedai', [KedaiController::class, 'update'])->name('kedai.update');

        // Announcement routes
        Route::get('/announcement', [AnnouncementController::class, 'index'])->name('announcement.index');
        Route::post('/announcement', [AnnouncementController::class, 'update'])->name('announcement.update');

        // Email settings routes
         Route::get('/email', [EmailSettingController::class, 'index'])->name('email.index');
        Route::post('/email', [EmailSettingController::class, 'update'])->name('email.update');
    });


});
