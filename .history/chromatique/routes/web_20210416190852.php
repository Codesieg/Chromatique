<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MangasController;
use App\Http\Controllers\TomesController;

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
//-------------- Route front ----------------
Route::get('/', [MangasController::class,'browse'])->name('browse_mangas');
Route::get('/tome/{id}', [TomesController::class,'browse'])->name('browse_tomes');

//-------------- Route back ----------------

Route::name('admin')->get('/admin', [AdminMangasController::class,'browse'])->name('admin_browse_mangas');
Route::name('admin')->get('/admin/add', [AdminMangasController::class,'add'])->name('admin_add_manga');
Route::name('admin')->get('/admin/delete/{id}', [AdminTomesController::class,'delete'])->name('admin_delete_manga');

