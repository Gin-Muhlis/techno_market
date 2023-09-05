<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UsersEndController;
use App\Http\Controllers\KetentuanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\TransaksiPenjualanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UsersEndController::class, 'index']);

Route::prefix('super/admin')->group(function() {
    Auth::routes();
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('barangs', BarangController::class);
        Route::resource('pelanggans', PelangganController::class);
        Route::resource('detail-penjualans', DetailPenjualanController::class);
        Route::resource('ketentuans', KetentuanController::class);
        Route::resource('kontaks', KontakController::class);
        Route::resource('penjualans', PenjualanController::class);
        Route::resource('produks', ProdukController::class);
        Route::resource('users', UserController::class);

        route::resource('transaksi-penjualan', TransaksiPenjualanController::class);
        Route::get('laporan-penjualan', [LaporanController::class, 'laporanPenjualan'])->name('laporan.penjualan');

        Route::get('export-penjualan',[ExportController::class, 'exportPenjualan'])->name('export.penjualan');
    });

Route::post('contact', [UsersEndController::class, 'contact'])->name('contact.sent');
Route::post('order', [UsersEndController::class, 'order'])->name('order.make');