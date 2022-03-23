<?php

namespace App\Http\Controllers;

use App\Models\Tomes;
use App\Models\User;
use App\Models\Mangas;
use App\Models\Pages;
use Illuminate\Http\Request;


class TomesController extends Controller
{

    /**
     * Show all the tomes from a manga in database.
     *
     * @return App\Models\Tomes
     */
    public function browse($id)
    {
        // On récupére la liste des tomes associé au manga
        $listTomes = Tomes::getTomesByManga($id);
        
        // On récupére le manga afin d'avoir le détails du manga
        $mangaDetails = Mangas::find($id);   
        $uploader = User::find($mangaDetails->uploader_id);

        // Pour chaque tome je dois aller récupérer les pages
        $page = Pages::where('tome_id', 9)->first();
        // dd($page);
        
        return view('tomes/browse', compact('listTomes', 'mangaDetails', 'uploader', 'page'));   
    }

    /**
     * Show all the pages from a tome in database.
     *
     * @return App\Models\Tomes
     */
    public function read($id)
    {
        $listPages = Tomes::getPagesByTome($id);
        return view('tomes/browse', compact('listPages',)   
        );
    }

    

}
