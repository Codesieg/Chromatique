<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mangas;

class MangasController extends Controller
{
    /**
     * Show all the mangs in database.
     *
     * @return App\Models\Mangas
     */
    public function show($id)
    {
        return view('single', [
            'mangas' => Mangas::findAll()
        ]);
    }
}
