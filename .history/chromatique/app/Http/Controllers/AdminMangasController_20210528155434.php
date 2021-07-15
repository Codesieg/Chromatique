<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Mangas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;

class AdminMangasController extends Controller
{
    /**
     * Show all the mangas in database.
     *
     * @return App\Models\Mangas
     */
    public function browse()
    {
        $listManga = Mangas::all();

        return view('admin/browse', [
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
        return view('admin/details', [
            'manga' => Mangas::find($id)
        ]);
    }

    /**
     * Modify the mangas by id.
     *
     * @return App\Models\Mangas
     */
    public function edit($id)
    {
        return view('edit', [
            'manga' => Mangas::find($id)
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
        $uploaderList = Users::All();
        // dd($uploaderList);

        return view('admin/form', 
        ['uploaderList' => $uploaderList]
    );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $mangaName = $request->input('mangaName');
        // $author = $request->input('author');
        // $synopsis = $request->input('synopsis');
        $uploaderId = $request->input('uploaderId');

        //Récupération de la couverture du manga
        $this->validate($request, [
                'mangaCover' => 'required',
                'mangaCover.*' => 'mimes:jpg,png'
        ]);
        // à la création d'un nouveau manga il faut créer un nouveau dossier
        // Récupérer le nom du fichier et le renomer
        
        // Ajout de la couverture du manga
        if($request->hasfile('mangaCover'))
        {
            $cover = $request->file('mangaCover');
            $name = '/' . $mangaName . '/' . $mangaName . '.' . $cover->extension();
            $cover->move(public_path().'/assets/mangas/'. ucfirst($mangaName), $name);  
        }

        $file= new Mangas();
        $file->manga_name = $mangaName;
        $file->manga_cover = ucfirst($name);
        // $file->author = $author;
        // $file->synopsis = $synopsis;
        $file->manga_cover = ucfirst($name);
        $file->uploader_id = $uploaderId ;
        $file->created_at = new \datetime();
        $file->save();

        // return redirect()->route('profile');
        return back()->with('success', 'Your new manga has been successfully added');
    }

    /**
     * DELETE a  manga.
     *
     * @return App\Models\Mangas
     */
    public function delete($id)
    {
        $manga = Mangas::find($id);

        if ($manga) {
            $manga::destroy($id);
            return back()->with($id . " supprimer", 200);
        } else {
            return back()->with('nop');
        }
    }

}
