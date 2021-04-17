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
        $listTomes = Tomes::find($id);

        return view('tomes/tomes', 'listTOmes' => $listTomes);
    }
}
