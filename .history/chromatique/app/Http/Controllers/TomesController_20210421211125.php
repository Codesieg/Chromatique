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
        // $listTomes = Tomes::All()
        // ->where('manga_id' $id)
        $listTomes = Tomes::where('manga_id', $id)
        ->orderBy('tome_name')
        ->take(10)
        ->get();


        return view('tomes/tomes', ['listTomes' => $listTomes]);
    }
}
