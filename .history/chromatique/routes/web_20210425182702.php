<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MangasController;
use App\Http\Controllers\TomesController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AdminMangasController;
use App\Http\Controllers\AdminTomesController;

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
)->name('browse_mangas');

Route::get(
    '/tome/{id}', 
    [TomesController::class,'browse']
)->name('browse_tomes');

Route::get(
    '/tome/page/{id}', 
    [PagesController::class,'read']
)->name('browse_pages');

//-------------- Route back manga ----------------

Route::get(
    '/admin',
    [AdminMangasController::class, 'browse']
)->name('admin_browse_mangas');

Route::get(
    '/admin/add/manga',
    [AdminMangasController::class, 'form']
)->name('admin_form_manga');

Route::post(
    '/admin/add',
    [AdminMangasController::class, 'add']
)->name('admin_add_manga');

Route::delete(
    '/admin/delete/{id}',
    [AdminMangasController::class, 'delete']
)->name('admin_delete_manga');

//-------------- Route back tome ----------------

Route::get(
    '/admin/add/tome/{id}',
    [AdminTomesController::class, 'form']
)->name('admin_form_tome');

Route::post(
    '/admin/add/tome',
    [AdminTomesController::class, 'add']
)->name('admin_add_tome');

Route::get(
    '/admin',
    [AdminTomesController::class, 'browse']
)->name('admin_browse_tome');

Route::delete(
    '/admin/delete/tome/{id}',
    [AdminTomesController::class, 'delete']
)->name('admin_delete_tome');