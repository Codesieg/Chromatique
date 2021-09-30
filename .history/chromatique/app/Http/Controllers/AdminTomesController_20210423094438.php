<?php

namespace App\Http\Controllers;

use App\Models\Tomes;
use App\Models\Mangas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Symfony\Component\Routing\Generator\UrlGenerator;

class AdminTomesController extends Controller
{
    /**
     * Show all the tomes in database.
     *
     * @return App\Models\Tomes
     */
    public function browse()
    {
        $listTomes = Tomes::all();

        return view('admin/browse', [
            'listTomes' => $listTomes
        ]);
    }
    
    /**
     * Show the tomes by id.
     *
     * @return App\Models\Tomes
     */
    public function read($id)
    {
        return view('admin/details', [
            'manga' => Tomes::find($id)
        ]);
    }

    /**
     * Modify the tomes by id.
     *
     * @return App\Models\Tomes
     */
    public function edit($id)
    {
        return view('edit', [
            'manga' => Tomes::find($id)
        ]);
    }

    /**
     * Add a new manga. 
     * 
     *
     * @return void
     */
    public function form($id)
    {
        $mangasLists = Mangas::where('manga_name', $id);
        dd($mangasLists);

        return view('admin/tomes/form', 
        ['mangasLists' => $mangasLists]
    );
    }

    /**
     *Add a new tome.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $tomeName = $request->input('tomeName');
        $tomeNumber = $request->input('tomeNumber');
        $mangaDirectory = $request->input('mangaDirectory');
        $mangaId = $request->input('mangaId');

        $this->validate($request, [
                'tomeJacket' => 'required',
                'tomeJacket.*' => 'mimes:jpg,png'
        ]);
         // à la création d'un nouveua manga il faut créer un nouveau dossier
        // Récupérer le nom du fichier et le renomer

        if($request->hasfile('tomeJacket'))
        {
            $jacket = $request->file('tomeJacket');
            // dump($jacket->path());
            // dump($jacket->hashName());
            $name = '/' . $tomeName . '/' . $tomeName . '.' . $jacket->extension();
            // dump($name);

            $jacket->move(public_path().'/assets/mangas/'. $mangaDirectory . ucfirst($tomeName), $name);
        }

        $file = new Tomes();
        $file->tome_name = $tomeName;
        $file->tome_jacket = ucfirst($name);
        $file->tome_number = $tomeNumber;
        $file->mangas_id = $mangaId;
        $file->created_at = new \datetime();
        $file->save();
        // dd($file);

        // return redirect()->route('profile');
        return back()->with('success', ' Your files has been successfully added');
    }

    /**
     * DELETE a  manga.
     *
     * @return App\Models\Tomes
     */
    public function delete($id)
    {
        $manga = Tomes::find($id);

        if ($manga) {
            $manga::destroy($id);
            return back()->with($id . " supprimer", 200);
        } else {
            return back()->with('nop');
        }
    }

}
