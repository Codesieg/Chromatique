<?php

namespace App\Http\Controllers;

use App\Models\Mangas;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MangasController extends Controller
{
    /**
     * Show new mangas in database.
     *
     * @return App\Models\Mangas
     */
    public function home()
    {
        // ne faut-il pas plus tôt ici récupérer les derniers tomes mise en ligne ?
        // $listManga = DB::table('mangas')->sortBy('manga_name')->limit(3);
        $listManga = Mangas::take(3)->orderByDesc('created_at')->get();
        // $userIsUploader = Auth::user()->isUploader;

        return view('mangas/home', [
            'listMangas' => $listManga,
            // 'userIsUploader' => $userIsUploader,
        ]);
    }
    /**
     * Show all the mangas in database.
     *
     * @return App\Models\Mangas
     */
    public function browse()
    {
        $listManga = Mangas::all()->sortBy('manga_name');
        return view('mangas/browse', [
            'listMangas' => $listManga
        ]);
    }
    
    /**
     * Show the mangas by id.
     *
     * @return App\Models\Mangas
     */
    public function read($id)
    {
        return view('mangas/details', [
            'manga' => Mangas::find($id)
        ]);
    }

}
