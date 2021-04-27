<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
        /**
     * Show all the page of a tome for a manga in database.
     *
     * @return App\Models\Mangas
     */
    public function browse($id)
    {
        
        $listPages = Pages::where('chapters_id', $id)
        // ->leftJoin('', 'users.id', '=', 'posts.user_id')
        ->get();

        // dd($listPages);
        return view('pages/browse', ['listPages' => $listPages]);
    }

    /**
 * Show all the tomes  from a manga in database.
 *
 * @return App\Models\Tomes
 */
public function read($id)
{
    $listPages = DB::table('mangas')
        ->select('pages.*',)
        ->leftJoin('tomes', 'mangas.id', '=', 'tomes.mangas_id')
        ->leftJoin('chapters', 'tomes.id', '=', 'chapters.tomes_id')
        ->leftJoin('pages', 'chapters.id', '=', 'pages.chapters_id')
        ->where('manga_id',$id)
        ->distinct()
        ->get();

    dd($listPages);

    return view('tomes/browse', compact('listPages',)   
    );
}

}


