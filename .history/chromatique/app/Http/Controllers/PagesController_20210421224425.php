<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
        /**
     * Show all the page of a tome for a manga in database.
     *
     * @return App\Models\Mangas
     */
    public function browse($id)
    {
        
        $listPages = Pages::where('mangas_id', $id)
        ->orderBy('tome_name')
        ->take(10)
        ->get();

        return view('pages/browse', ['listPages' => $listPages]);
    }

}
