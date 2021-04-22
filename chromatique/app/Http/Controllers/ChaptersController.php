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
        
        $listChapters = Chapters::where('tomes_id', $id)
        ->orderBy('chapter_number')
        ->take(50)
        ->get();

        return view('chapters/browse', ['listChapters' => $listChapters]);
    }
}
