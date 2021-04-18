<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MangasController;
use App\Http\Controllers\TomesController;
use App\Http\Controllers\AdminMangasController;

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
// Route::get('/', [MangasController::class,'browse'])->name('browse_mangas');

Route::get(
    '/',
    [MangasController::class, 'browse']
)->name('browse_manga');


Route::get('/tome/{id}', [TomesController::class,'browse'])->name('browse_tomes');

//-------------- Route back ----------------


Route::get(
    '/admin',
    [AdminMangasController::class, 'browse']
)->name('admin_browse_mangas');


Route::get(
    '/admin/add',
    [AdminMangasController::class, 'add']
)->name('admin_form_manga');

Route::post(
    '/admin/add',
    [AdminMangasController::class, 'create']
)->name('admin_add_manga')

Route::get(
    '/admin/delete/{id',
    [AdminMangasController::class, 'delete']
)->name('admin_delete_manga');



