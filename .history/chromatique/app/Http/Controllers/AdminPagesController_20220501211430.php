<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pages;
use App\Models\Mangas;
use App\Models\Tomes;

use Illuminate\Http\Request;

class AdminPagesController extends Controller
{
    /**
     * Show all the pages in database.
     *
     * @return App\Models\Mangas
     */
    public function browse()
    {
        $listManga = Mangas::all()->sortBy('manga_name');

        return view('admin/browse', [
            'listMangas' => $listManga,
        ]);
    }

        /**
     * Show the pages by id.
     *
     * @return App\Models\Tomes
     */
    public function read($id)
    {
        $tome = Tomes::find($id);
        $listPages = Pages::where('tomes_id', $id)->orderBy('page_file')->get();
        $mangaName = Mangas::find($tome->manga_id);

        return view('admin/tomes/detail', compact('listPages', 'mangaName', 'tome'));
    }

}

    