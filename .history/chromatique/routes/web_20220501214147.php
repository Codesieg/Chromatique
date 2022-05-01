<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TomesController;
use App\Http\Controllers\MangasController;
// use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminTomesController;
use App\Http\Controllers\Admin\AdminMangasController;
use App\Http\Controllers\Admin\AdminPagesController;
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

Route::get(
    '/',
    [MangasController::class, 'home']
)->name('browse_mangas');

Route::get(
    '/tome/browse/{id}', 
    [TomesController::class,'browse']
)->name('browse_tomes');

Route::get(
    '/tome/page/{id}', 
    [PagesController::class,'read']
)->name('browse_pages');

Route::get(
    '/mangas', 
    [MangasController::class,'browse']
)->name('browse_all_mangas');


//-------------- Route back-office manga ----------------

Route::get(
    '/admin',
    [AdminMangasController::class, 'browse']
)->name('admin_browse_mangas')->middleware('auth');

// Route affichant le formulaire d'ajout d'un manga
Route::get(
    '/admin/add/manga',
    [AdminMangasController::class, 'form']
)->name('admin_form_manga')->middleware('auth');

//  Route ajoutant le manga, au clique sur le formulaire
Route::post(
    '/admin/add/manga',
    [AdminMangasController::class, 'add']
)->name('admin_add_manga')->middleware('auth');

// Supprimer un manga
Route::delete(
    '/admin/delete/{id}',
    [AdminMangasController::class, 'delete']
)->name('admin_delete_manga')->middleware('auth');

//  Route qui vient scanner le dossier publique au clique sur le bouton scanner
Route::post(
    '/admin/insert',
    [AdminMangasController::class, 'insert']
)->name('admin_insert_manga')->middleware('auth');

// Permet d'afficher le forms de modification d'un manga
Route::get(
    '/admin/manga/edit/{id}',
    [AdminMangasController::class, 'form_edit']
)->name('admin_form_edit_manga')->middleware('auth');

// Permet d'enregistrer les modifications d'un manga
Route::patch(
    '/admin/manga/edit/{id}',
    [AdminMangasController::class, 'edit']
)->name('admin_edit_manga')->middleware('auth');

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

// Permet d'afficher le forms de modification d'un tome
Route::get(
    '/admin/tomes/edit/{id}',
    [AdminTomesController::class, 'form_edit']
)->name('admin_form_edit_tome')->middleware('auth');

// Permet de modifier un tome
Route::patch(
    '/admin/tome/edit/{id}',
    [AdminTomesController::class, 'edit']
)->name('admin_edit_tome')->middleware('auth');

//-------------- Route back-office page ----------------

// On liste tous les pages d'un tome
Route::get(
    '/admin/page/{id}',
    [AdminPagesController::class, 'read']
)->name('admin_read_page')->middleware('auth');


// ---------------route d'authentification------------

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
