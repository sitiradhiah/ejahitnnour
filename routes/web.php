<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KatelogController;
use App\Http\Controllers\TempahanController;
use App\Http\Controllers\AduanCadanganController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;

//route sebelum login
Route::get('/', function () {
    return view('index');
});
Route::get('/tentangkami', function () {
    return view('about');
})->name('about');
// Route::get('/katelog', function () { //route (url)
//     return view('katelog'); //blade view file
// })->name('katelog');
Route::get('/KatalogUmum', [KatelogController::class, 'KatalogUmum'])->name('KatalogUmum');
// Route::resource('katelog', KatelogController::class);
Route::get('/hubungi-kami', function () {
    return view('hubungi-kami');
})->name('hubungi.kami');

//LOGIN & LOGOUT Pengguna Berdaftar
Route::prefix('logmasuk')->controller(AuthController::class)->group(function () {
    Route::get('/', 'logmasuk')->name('logmasuk');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

// POST /hubungi-kami - for public form submission
Route::post('/hubungi-kami', [AduanCadanganController::class, 'store'])->name('aduan.store');

// Add all routes that require authentication here
//route selepas login
Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.Dashboard');
    })->name('dashboard');

    Route::prefix('katelog')->controller(KatelogController::class)->group(function () {
        Route::get('/', 'index')->name('katelog.senarai');
        Route::post('/store', 'store')->name('katelog.store'); // <-- ini WAJIB ADA
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


    // Route::get('/profile', function () {
    //     return view('profile');
    // })->name('profile');

    // Route::get('/settings', function () {
    //     return view('settings');
    // })->name('settings');

    // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route::get('/pengurusan-katelog', function () {
    //     return view('admin.pengurusan-katelog'); // atau 'admin.pengurusan-katelog' jika dalam folder admin
    // })->name('pengurusan-katelog');

});

