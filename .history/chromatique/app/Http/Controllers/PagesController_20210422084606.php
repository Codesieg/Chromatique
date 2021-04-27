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
        
        $listPages = Pages::where('chapters_id', $id)
        // ->leftJoin('', 'users.id', '=', 'posts.user_id')
        ->get();

        return view('pages/browse', ['listPages' => $listPages]);
    }

}
