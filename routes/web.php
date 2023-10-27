<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\MasterKategoriController;
use App\Http\Controllers\MasterGudangController;
use App\Http\Controllers\LoginController;
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

Route::get('/', function () {return view('welcome');});

Route::get('/login',[LoginController::class,'index'])
->name('login')
->middleware('guest');

Route::post('/login',[LoginController::class,'authenticate'])
->name('kirim-data-login');

Route::get('/logout',[LoginController::class,'logout'])
->name('logout');

Route::get('/dashboard',[DashboardController::class,'index'])
->middleware('auth');

Route::get('/master',[MasterController::class,'index'])
->name('master')
->middleware('auth');

Route::get('/master/barang',[MasterBarangController::class,'index'])
->name('master-barang')
->middleware('auth');

Route::get('/master/barang/tambah',[MasterBarangController::class,'create'])
->name('master-barang-tambah')
->middleware('auth');

Route::post('/master/barang/simpan',[MasterBarangController::class,'store'])
->name('master-barang-simpan')
->middleware('auth');

Route::get('/master/kategori',[MasterKategoriController::class,'index'])
->name('master-kategori')
->middleware('auth');

Route::get('/master/gudang',[MasterGudangController::class,'index'])
->name('master-gudang')
->middleware('auth');
