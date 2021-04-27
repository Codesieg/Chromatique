<?php

namespace App\Http\Controllers;

use App\Models\Tomes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TomesController extends Controller
{
   
    /**
     * Show all the tomes  from a manga in database.
     *
     * @return App\Models\Tomes
     */
    // public function browse($id)
    // {

    //     // $listTomes = Tomes::where('mangas_id', $id)
    //     // ->orderBy('tome_name')
    //     // ->get();


    //     // $idChapters = Tomes::find($id)->chapters()
    //     // ->get();

    //     dump($listTomes);

    //     return view('tomes/browse', compact('listTomes',)   
    //     );
    // }


    /**
     * Show all the tomes  from a manga in database.
     *
     * @return App\Models\Tomes
     */
    public function browse($id)
    {
        $listTomes = DB::table('Tomes')
            ->leftJoin('chapters', 'tomes.id', '=', 'chapters.tomes_id')
            ->leftJoin('pages', 'chapters.id', '=', 'pages.chapters_id')
            ->select('tomes.*', 'pages.*',)
            ->get();


        // $listTomes = Tomes::where('mangas_id', $id)
        // ->orderBy('tome_name')
        // ->get();


        // $idChapters = Tomes::find($id)->chapters()
        // ->get();

        dd($listTomes);

        return view('tomes/browse', compact('listTomes',)   
        );
    }

}
