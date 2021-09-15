<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TomesController;
use App\Http\Controllers\MangasController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminTomesController;
use App\Http\Controllers\Admin\AdminMangasController;


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

// Route::post(
//     '/logout', 
//     [LoginController::class,'logout']
// )->name('user_logout');

//-------------- Route back-office manga ----------------

Route::get(
    '/admin',
    [AdminMangasController::class, 'browse']
)->name('admin_browse_mangas')->middleware('auth');

Route::get(
    '/admin/add/manga',
    [AdminMangasController::class, 'form']
)->name('admin_form_manga')->middleware('auth');

Route::post(
    '/admin/add/manga',
    [AdminMangasController::class, 'add']
)->name('admin_add_manga')->middleware('auth');

Route::delete(
    '/admin/delete/{id}',
    [AdminMangasController::class, 'delete']
)->name('admin_delete_manga')->middleware('auth');

//-------------- Route back-office tome ----------------

// On récupère l'id du manga sur cette route et on affiche le formulaire d'ajout d'un tome par rapport à ça franchise
Route::get(
    '/admin/add/tome/{id}',
    [AdminTomesController::class, 'form']
)->name('admin_form_tome')->middleware('auth');

// On ajoute un tome
Route::post(
    '/admin/add/tome',
    [AdminTomesController::class, 'add']
)->name('admin_add_tome')->middleware('auth');

// On liste tous les tomes de tous les mangas
Route::get(
    '/admin/tome/',
    [AdminTomesController::class, 'browse']
)->name('admin_browse_tomes')->middleware('auth');

// On liste tous les tomes d'un manga
Route::get(
    '/admin/tome/{id}',
    [AdminTomesController::class, 'read']
)->name('admin_read_tome')->middleware('auth');

// Permet de supprimer un tome
Route::delete(
    '/admin/delete/tome/{id}',
    [AdminTomesController::class, 'delete']
)->name('admin_delete_tome')->middleware('auth');

// Permet de modifier un tome
Route::get(
    '/admin/tome/edit/{id}',
    [AdminTomesController::class, 'edit']
)->name('admin_edit_tome')->middleware('auth');

// ---------------route d'authentification------------

Auth::routes();

