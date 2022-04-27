<?php

namespace App\Http\Controllers;

use App\Models\Mangas;
use Illuminate\Support\Facades\Auth;



class MangasController extends Controller
{
    /**
     * Show new mangas in database.
     *
     * @return App\Models\Mangas
     */
    public function home()
    {
        $listManga = Mangas::all()->sortBy('manga_name');
        dd(Auth::uisUploader());

        return view('mangas/home', [
            'listMangas' => $listManga
        ]);
    }
    /**
     * Show all the mangas in database.
     *
     * @return App\Models\Mangas
     */
    public function browse()
    {
        $listManga = Mangas::select('manga_name')->get();
        return view('mangas/browse', [
            'listMangas' => $listManga
        ]);
    }
    
    /**
     * Show the mangas by id.
     *
     * @return App\Models\Mangas
     */
    public function read($id)
    {
        return view('mangas/details', [
            'manga' => Mangas::find($id)
        ]);
    }

}
