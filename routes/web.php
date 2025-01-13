<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KatelogController;
use App\Http\Controllers\TempahanController;


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

// Add all routes that require authentication here
//route selepas login
Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.Dashboard');
    })->name('dashboard');

    Route::prefix('katelog')->controller(KatelogController::class)->group(function () {
        Route::get('/', 'index')->name('katelog.senarai');
        Route::get('/kategori', 'kategori')->name('katelog.kategori'); // Route untuk Kategori Pakaian
        Route::post('/store', 'store')->name('katelog.store');
        Route::post('/update/{id}', 'update')->name('katelog.update');
        Route::delete('/destroy/{id}', 'destroy')->name('katelog.destroy');
    });
    

    Route::get('/tempahan/senarai', [TempahanController::class, 'senarai'])->name('tempahan.senarai');
    Route::get('/tempahan/baru', [TempahanController::class, 'baru'])->name('tempahan.baru');
    Route::get('tempahan/{id}/edit', [TempahanController::class, 'edit'])->name('tempahan.edit');
    Route::resource('tempahan', TempahanController::class);

    Route::prefix('janaan-laporan')->middleware(['auth'])->group(function () {
        Route::get('/', function () {
            return view('admin.penjanaan');
        })->name('janaan-laporan.index');
    });

    Route::prefix('aduan-cadangan')->middleware(['auth'])->group(function () {
        Route::get('/', function () {
            return view('admin.aduan');
        })->name('aduan-cadangan.index');
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

