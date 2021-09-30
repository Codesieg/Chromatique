<?php

namespace App\Http\Controllers;

use App\Models\Chapters;
use Illuminate\Http\Request;

class ChaptersController extends Controller
{
        /**
     * Show all the chapters for one tome from database.
     *
     * @return App\Models\Chapters
     */
    public function browse($id)
    {
        
        $listChapters = Chapters::where('mangas_id', $id)
        ->orderBy('tome_name')
        ->take(10)
        ->get();

        return view('tomes/tomes', ['listChapters' => $listChapters]);
    }
}
