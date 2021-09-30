<?php

namespace App\Http\Controllers;

use App\Models\Tomes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;

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
    public function form()
    {
        $uploaderList = User::All();
        // dd($uploaderList);

        return view('admin/tomes/form', 
        ['uploaderList' => $uploaderList]
    );
    }

    /**
     *Add a new tome.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $mangaName = $request->input('mangaName');
        $author = $request->input('author');
        $synopsis = $request->input('synopsis');
        $userId = $request->input('userId');

        $this->validate($request, [
                'mangaJacket' => 'required',
                'mangaJacket.*' => 'mimes:jpg,png'
        ]);
         // à la création d'un nouveua manga il faut créer un nouveau dossier
        // Récupérer le nom du fichier et le renomer

        if($request->hasfile('mangaJacket'))
        {
            $jacket = $request->file('mangaJacket');
            // dump($jacket->path());
            // dump($jacket->hashName());
            $name = '/' . $mangaName . '/' . $mangaName . '.' . $jacket->extension();
            // dump($name);

            $jacket->move(public_path().'/assets/tomes/'. ucfirst($mangaName), $name);  
        }

        $file= new Tomes();
        $file->manga_name = $mangaName;
        $file->manga_jacket = ucfirst($name);
        $file->author = $author;
        $file->synopsis = $synopsis;
        $file->users_id = $userId ;
        $file->created_at = new \datetime();
        $file->save();

        // return redirect()->route('profile');
        return back()->with('success', 'Data Your files has been successfully added');
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
