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
    public function browse($id)
    {
        $listTomes = DB::table('Tomes')
            ->join('chapters', 'tomes.id', '=', 'chapters.tomes_id')
            ->join('pages', 'chapters.id', '=', 'pages.chapters_id')
            ->select('tomes.*', 'chapters.*', 'pages.*',)
            ->get();


        // $listTomes = Tomes::where('mangas_id', $id)
        // ->orderBy('tome_name')
        // ->get();


        // $idChapters = Tomes::find($id)->chapters()
        // ->get();

        // dump($listTomes);

        return view('tomes/browse', compact('listTomes',)   
        );
    }

}
