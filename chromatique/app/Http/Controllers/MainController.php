<?php

namespace App\Http\Controllers;

use App\Models\manga;


class MainController extends Controller
{

    public function listAll()
    {

        $mangas = new Manga();
        $listMangas = $mangas->getManga();
        // dd($listMangas);

        return view('home', compact('listMangas'));
    }
}
