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
    public function browse($id)
    {
        return view('single', [
            'mangas' => Mangas::findAll()
        ]);
    }
    
    /**
     * Show the mangas by id.
     *
     * @return App\Models\Mangas
     */
    public function read($id)
    {
        return view('details', [
            'manga' => Mangas::find($id)
        ]);
    }

    /**
     * Modify the mangas by id.
     *
     * @return App\Models\Mangas
     */
    public function edit($id)
    {
        return view('add', [
            'manga' => Mangas::find($id)
        ]);
    }

    /**
     * Add a new manga.
     *
     * @return App\Models\Mangas
     */
    public function add()
    {
        return view('details', [
            'manga' => Mangas::find()
        ]);
    }

    /**
     * Add a new manga.
     *
     * @return App\Models\Mangas
     */
    public function delete($id)
    {
        return view('details', []);
    }

}
