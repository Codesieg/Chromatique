<?php

namespace App\Http\Controllers;

use App\Models\Tomes;
use App\Models\Mangas;
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
        // On récupére le manga afin d'avoir le datails des fichiers
        $mangaDetails = Mangas::find($id);   
        $uploader = Users::find($mangaDetails->uploader_id);
        
        return view('tomes/browse', compact('listTomes', 'mangaDetails'));   
    }

    /**
     * Show all the tomes from a manga in database.
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
