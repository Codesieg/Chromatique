<?php

namespace App\Http\Controllers;

use App\Models\Tomes;
use App\Models\Mangas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TomesController extends Controller
{

    /**
     * Show all the tomes from a manga in database.
     *
     * @return App\Models\Tomes
     */
    public function browse($id)
    {

        // $listTomes = Tomes::where('mangas_id', $id)
        // ->orderBy('tome_name')
        // ->get();
        // // dump($listTomes);

        // $pathManga = Mangas::where('id', $id)
        // ->get();
        // // dd($pathManga);

        $listTomes = DB::table('mangas')
            ->select('tomes.*', 'mangas.manga_directory',)
            ->leftJoin('tomes', 'mangas.id', '=', 'tomes.manga_id')
            ->where('mangas.id',$id)
            ->distinct()
            ->get();
        // dump($listTomes);
        return view('tomes/browse', compact('listTomes', ));   
    }


    /**
     * Show all the tomes from a manga in database.
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


        // $listTomes = Tomes::where('mangas_id', $id)
        // ->orderBy('tome_name')
        // ->get();


        // $idChapters = Tomes::find($id)->chapters()
        // ->get();

        dd($listPages);

        return view('tomes/browse', compact('listPages',)   
        );
    }

    

}
