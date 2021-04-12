<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mangas

class MangasController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
    }
}
