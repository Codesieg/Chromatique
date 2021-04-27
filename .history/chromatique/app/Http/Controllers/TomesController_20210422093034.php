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
        $listTomesChapters= [];
        
        $listTomes = Tomes::where('mangas_id', $id)
        ->orderBy('tome_name')
        ->get();

        $listTomesChapters[] = $listTomes;

        $idChapters = Tomes::find($id)->chapters()
        ->get();

        $listTomesChapters[] = $idChapters;

        dd($listTomesChapters);

        return view('tomes/browse', [
            'listTomes' => $listTomes,
            'idChapters' => $idChapters,
        ]);
    }

}