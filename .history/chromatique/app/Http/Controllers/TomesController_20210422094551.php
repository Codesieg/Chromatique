<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tomes;

class TomesController extends Controller
{
    /**
     * Show all the mangs in database.
     *
     * @return App\Models\Mangas
     */
    public function browse($id)
    {
        
        $listTomes = Tomes::where('mangas_id', $id)
        ->orderBy('tome_name')
        ->get();


        $idChapters = Tomes::find($id)->chapters()
        ->get();

        // dd($listTomesChapters);

        return view('tomes/browse', compact( 'listTomes',
            'idChapters',)   
        );
    }

}
