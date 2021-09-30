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
    public function browse()
    {
        
        // $listPages = Pages::where('chapters_id', $id)
        // // ->leftJoin('', 'users.id', '=', 'posts.user_id')
        // ->get();

        // // dd($listPages);
        // return view('pages/browse', ['listPages' => $listPages]);
    }

    /**
 * Show all the tomes  from a manga in database.
 *
 * @return App\Models\Tomes
 */
public function read($id)
{
    $listPages = DB::table('pages')
        ->select('pages.*',)
        ->where('pages.tome_id',$id)
        ->orderBy('page_file')
        ->distinct()
        ->get();

    // dump($listPages);

    return view('pages/browse', compact('listPages',)   
    );
}

}


