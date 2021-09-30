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
        // On récupére le nom du manga et on supprime les espaces vide en debut et fin
        $mangaName = $request->input(trim('mangaName'));
        // $author = $request->input('author');
        // $synopsis = $request->input('synopsis');
        $uploaderId = $request->input('uploaderId');

        //Récupération de la couverture du manga et verification de son type
        $this->validate($request, [
                'mangaCover' => 'required',
                'mangaCover.*' => 'mimes:jpg,png'
        ]);

        // Ajout de la couverture du manga
        if($request->hasfile('mangaCover'))
        {
            // Récupération du fichier uploader
            $cover = $request->file('mangaCover');
            // On prend le nom du manga puis on renomme le fichier uploader avec 
            // le son nom et on ajoute l'extension du fichier uploader le chemin du fichier est ex : one_piece/one_piece.jpg

            // On sépare la string pour reformatter le text et on passe tout en minuscule
            $mangaDirectory = strtolower($mangaName);
            $mangaDirectory = explode(' ', $mangaDirectory);
            $mangaDirectory = '/' . implode('_', $mangaDirectory);

            // On attribue le même nom au fichier de la cover
            $coverName = $mangaDirectory;

            // On définit le chemin du fichier cover pour la BDD
            $coverPath = '/' . $mangaDirectory . '/' . $coverName . '.' . $cover->extension();
            $mangaPath = '/' . $mangaDirectory . '/' . $coverName . '.' . $cover->extension();

            $publicPath = public_path().'/assets/mangas/'. $mangaDirectory;
            // On déplace le fichier dans le répertoire assets du dossier public
            $cover->move($publicPath, $mangaPath);  
        }



        $file= new Mangas();
        $file->manga_name = ucfirst($mangaName);
        $file->manga_cover = ucfirst($coverPath);
        $file->manga_directory = ucfirst($mangaDirectory);
        // $file->author = $author;
        // $file->synopsis = $synopsis;
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
