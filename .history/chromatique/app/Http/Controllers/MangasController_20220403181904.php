<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mangas;

class MangasController extends Controller
{
    /**
     * Show all the mangas in database.
     *
     * @return App\Models\Mangas
     */
    public function browse()
    {
        $listManga = Mangas::all()->sortBy('manga_name');

        $listMangaName = [];
        foreach ($listManga as $manga) {
            $mangaName = filter_var($manga, FILTER_SANITIZE_STRING);
            $listMangaName[] = $mangaName;
        }
        dd($listMangaName);
        return view('mangas/home', [
            // 'listMangas' => $listManga
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
