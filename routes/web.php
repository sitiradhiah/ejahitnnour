<?php

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

Route::get('/', function () {
    return view('index');
});

// Route for the about page
Route::get('/tentangkami', function () {
    return view('about');
})->name('about'); // Add name to the route

Route::get('/katelog', function () { //route (url)
    return view('katelog'); //blade view file
});

Route::get('/hubungi-kami', function () {
    return view('hubungi-kami');
})->name('hubungi.kami'); // Add name to the route

// Login page
Route::get('/logmasuk', function () {
    return view('logmasuk');
})->name('login'); // Added route name for proper navigation

Route::prefix('admin')->group(function () {
    Route::get('index', function () {
        return view('admin.index');
    })->name('admin.index');

    // Route::prefix('component')->group(function () {
    //     Route::get('alert', function () {
    //         return view('admin.component-alert');
    //     })->name('admin.component.alert');

    //     Route::get('badge', function () {
    //         return view('admin.component-badge');
    //     })->name('admin.component.badge');

    //     Route::get('breadcrumb', function () {
    //         return view('admin.component-breadcrumb');
    //     })->name('admin.component.breadcrumb');

    //     Route::get('button', function () {
    //         return view('admin.component-button');
    //     })->name('admin.component.button');

    //     Route::get('card', function () {
    //         return view('admin.component-card');
    //     })->name('admin.component.card');

    //     Route::get('carousel', function () {
    //         return view('admin.component-carousel');
    //     })->name('admin.component.carousel');

    //     Route::get('dropdown', function () {
    //         return view('admin.component-dropdown');
    //     })->name('admin.component.dropdown');

    //     Route::get('list-group', function () {
    //         return view('admin.component-list-group');
    //     })->name('admin.component.listGroup');

    //     Route::get('modal', function () {
    //         return view('admin.component-modal');
    //     })->name('admin.component.modal');

    //     Route::get('navs', function () {
    //         return view('admin.component-navs');
    //     })->name('admin.component.navs');

    //     Route::get('pagination', function () {
    //         return view('admin.component-pagination');
    //     })->name('admin.component.pagination');

    //     Route::get('progress', function () {
    //         return view('admin.component-progress');
    //     })->name('admin.component.progress');

    //     Route::get('spinner', function () {
    //         return view('admin.component-spinner');
    //     })->name('admin.component.spinner');

    //     Route::get('tooltip', function () {
    //         return view('admin.component-tooltip');
    //     })->name('admin.component.tooltip');
    // });

    // Route::prefix('extra-component')->group(function () {
    //     Route::get('avatar', function () {
    //         return view('admin.extra-component-avatar');
    //     })->name('admin.extra-component.avatar');

    //     Route::get('sweetalert', function () {
    //         return view('admin.extra-component-sweetalert');
    //     })->name('admin.extra-component.sweetalert');

    //     Route::get('toastify', function () {
    //         return view('admin.extra-component-toastify');
    //     })->name('admin.extra-component.toastify');
    // });
});
