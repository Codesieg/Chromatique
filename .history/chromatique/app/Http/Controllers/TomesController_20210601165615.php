<?php

namespace App\Http\Controllers;

use App\Models\Tomes;
use App\Models\Mangas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('tomes/browse', compact('listTomes', ));   
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