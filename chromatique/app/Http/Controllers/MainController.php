<?php

namespace App\Http\Controllers;

use App\Models\mangas;


class MainController extends Controller
{

    public function listAll()
    {

        $mangas = new Mangas();
        $listMangas = $mangas->getManga();
        // dd($listMangas);

        return view('home', compact('listMangas'));
    }
}
