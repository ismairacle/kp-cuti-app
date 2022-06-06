<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApproverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\VerifyUserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Cuti;

Auth::routes();


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(AdminController::class)->group(
        function () {
            Route::get('/admin', 'index')->name('admin');
            Route::get('/admin/{id}/detail', 'profile')->name('detail-user');
            Route::get('/admin/{id}/update', 'edit')->name('edit-user');
            Route::get('/all', 'all')->name('all');
        }
    );

    Route::controller(UserController::class)->group(function () {
        Route::get('/tambah-user', 'tambah')->name('tambah-user');
        Route::post('/insert-user', 'insert')->name('insert-user');
        Route::post('/update-user', 'update')->name('update-user');
    });

    Route::controller(PengajuanController::class)->group(function () {
        Route::get('/{id}/detail/', 'detail')->name('detail');

    });
});


Route::middleware(['auth', 'role:approver'])->group(
    function () {
        Route::get('/approver', [ApproverController::class, 'index'])->name('approver');
        Route::get('/rejected', [ApproverController::class, 'rejected'])->name('rejected');
        Route::get('/approved', [ApproverController::class, 'approved'])->name('approved');

        Route::controller(PengajuanController::class)->group(function () {
            Route::get('/{id}/detail/', 'detail')->name('detail');
            Route::post('/accept', 'accept')->name('accept');
            Route::post('/reject', 'reject')->name('reject');
    
        });
    }
    
);




Route::middleware(['auth'])->group(function () {
    Route::controller(VerifyUserController::class)->group(
        function () {
            Route::get('/', 'index')->name('verify');
        }
    );
});



Route::middleware(['auth', 'role:user'])->group(function () {

    Route::controller(UserController::class)->group(function () {
        Route::get('/home', 'index')->name('index');
        Route::get('/profil', 'profil')->name('profil');
        Route::get('/ubah-password', 'password')->name('ubah-password');
        Route::post('/edit-password', 'edit_password')->name('edit-password');
        Route::get('/ubah-data', 'data')->name('ubah-data');
        Route::post('/edit-data', 'edit_data')->name('edit-data');
    });

    Route::controller(PengajuanController::class)->group(function () {
        Route::get('/pengajuan', 'pengajuan')->name('pengajuan');
        Route::get('/pengajuan/riwayat', 'riwayat')->name('riwayat');
        Route::get('/pengajuan/status', 'status')->name('status');
        Route::get('/pengajuan/{id}/detail/', 'detail')->name('detail');
        Route::get('/pengajuan/{id}/update/', 'update')->name('update');
        Route::get('/pengajuan/{id}/delete/', 'delete')->name('delete');
        Route::post('/create', 'insert')->name('create');
        Route::post('/edit', 'edit')->name('edit');
    });
});
