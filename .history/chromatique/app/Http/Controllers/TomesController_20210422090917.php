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
        
        $listTomes = Tomes::find($id)->chapters()
        // ->orderBy('tome_name')
        ->take(10)
        ->get();
dd($listTomes);
        return view('tomes/browse', ['listTomes' => $listTomes]);
    }

}
