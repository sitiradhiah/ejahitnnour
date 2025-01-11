<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KatelogController;


//route sebelum login
Route::get('/', function () {
    return view('index');
});
Route::get('/tentangkami', function () {
    return view('about');
})->name('about'); 
Route::get('/katelog', [KatelogController::class, 'showKatalog']); 
Route::resource('katalog', KatelogController::class); 
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
        return view('admin.index');
    })->name('dashboard');

    Route::prefix('pengurusan-katalog')->controller(KatelogController::class)->group(function () {
        Route::get('/', 'index')->name('pengurusan-katalog');
        Route::post('/store', 'store')->name('katalog.store');
        Route::post('/update/{id}', 'update')->name('katalog.update');
        Route::delete('/destroy/{id}', 'destroy')->name('katalog.destroy');
    });

    // Route::get('/profile', function () {
    //     return view('profile');
    // })->name('profile');

    // Route::get('/settings', function () {
    //     return view('settings');
    // })->name('settings');

    // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route::get('/pengurusan-katalog', function () {
    //     return view('admin.pengurusan-katalog'); // atau 'admin.pengurusan-katalog' jika dalam folder admin
    // })->name('pengurusan-katalog');
    
});

