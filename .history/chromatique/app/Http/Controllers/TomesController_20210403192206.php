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
    public function browse()
    {
        $listTomes = Tomes::all(;

        return view('tomes', compact('listTomes'));
    }
}
