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
        $listTomes = Tomes::getTomesByManga($id);
        $mangaBanner = Mangas::find($id)->manga_banner;   
        dd($mangaBanner);
        
        return view('tomes/browse', compact('listTomes', 'mangaBanner'));   
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
