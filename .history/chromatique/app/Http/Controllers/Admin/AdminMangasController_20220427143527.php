<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mangas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class AdminMangasController extends Controller
{
    /**
     * Show all the mangas in database.
     *
     * @return App\Models\Mangas
     */
    public function browse()
    {
        $listManga = Mangas::all()->sortBy('manga_name');

        return view('admin/browse', [
            'listMangas' => $listManga,
        ]);
    }
    
    /**
     * Show the manga by id.
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
     * Show the forms to modify manga by id.
     *
     * @return App\Models\Mangas
     */
    public function form_edit($id)
    {
        $manga = Mangas::find($id);
        
        // Retourne le formulaire prés-rempli avec les données du manga
        return view('admin/form_edit', [
            'manga' => $manga
        ]);
    }

    /**
     * Modify the mangas by id.
     *
     * @return App\Models\Mangas
     */
    public function edit($id, Request $request, User $user) {
        // $this->authorize('edit', $user);

        $author = $request->input('author');
        $synopsis = $request->input('synopsis');
        $mangaBanner = $request->input('banner');
        $mangaCover = $request->input('cover');
        
        // dump($id);
        $manga = Mangas::where("id", $id)->update(
            ['manga_cover' => $mangaCover . ".jpg",
            'manga_directory' => "/". $request->input(trim('mangaName')),
            'manga_banner' => "/" . $mangaBanner,
            'manga_author' => $author,
            'manga_synopsis' => $synopsis,
            'uploader_id' => Auth::user()->id,
            'updated_at' => new \datetime()],
        );
        $listManga = Mangas::all()->sortBy('manga_name');
        // dd($manga);
        return view('admin/browse', [
            'listMangas' => $listManga,
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
        // il faut récupérer l'utilisateur de la session en cours plutôt que de lister touts les uploaders
        $uploaderList = User::All();
        // dd($uploaderList);

        return view('admin/form', 
        ['uploaderList' => $uploaderList]
    );
    }

    /**
     * Add a new manga.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        // On récupére le nom du manga et on supprime les espaces vide en debut et fin
        $mangaName = $request->input(trim('mangaName'));
        $author = $request->input('author');
        $synopsis = $request->input('synopsis');
        //Récupération de la couverture du manga et verification de son type
        $this->validate($request, [
                'mangaCover' => 'required',
                // 'mangaBanner' => 'required',
                'mangaCover.*' => 'mimes:jpg,png'
        ]);
            // Ajout de la couverture du manga
            if($request->hasfile('mangaCover'))
            {
                $formatName = str_replace(' ', '_', $mangaName);
                $coverName = $formatName . '.' . $request->file('mangaCover')->extension();

                // Récupération du fichier uploadé
                $cover = Storage::putFileAS($formatName, $request->file('mangaCover'), $coverName, 'local');
                // dd($cover);

                // On prend le nom du manga puis on renomme le fichier uploadé avec 
                // son nom et on ajoute à l'extension du fichier uploadé le chemin du fichier ex : one_piece/one_piece.jpg

                // On sépare la string pour reformatter le text et on passe tout en minuscule
                $mangaDirectory = strtolower($mangaName);
                $mangaDirectory =  str_replace(' ', '_', $mangaName );

                // On attribue le même nom au fichier de la cover
                $coverName = $mangaDirectory;

                // On déplace le fichier dans le répertoire mangas du dossier storage
                // Chemin vers le fichier manga
                $mangaPath = $mangaDirectory .'/'. $coverName . '.' . $cover->extension();
                
                // Chemin vers le dossier storage
                $publicPath = $mangaDirectory;
                dd($publicPath);
                $cover->move($publicPath, $mangaPath);  

            // $file= new Mangas();
            // $file->manga_name = ucfirst($mangaName);
            // $file->manga_cover = ucfirst($coverPath);
            // // $file->manga_directory = '/' . $mangaDirectory;
            // $file->manga_author = $author;
            // $file->manga_synopsis = $synopsis;
            // $file->manga_bannerPath = $bannerPath;
            // // $file->uploader_id = $uploaderId ;
            // $file->updated_at = new \datetime();
            // $file->save();


        Mangas::firstOrCreate(
            ['manga_name' => $mangaName],
            ['manga_cover' => $coverPath,
            'manga_directory' => "/". $mangaDirectory,
            'manga_banner' => "/" . $mangaBanner,
            'manga_author' => $author,
            'manga_synopsis' => $synopsis,
            'uploader_id' => Auth::user()->id,
            'created_at' => new \datetime()],
        );
    }
        // return redirect()->route('profile');
        return back()->with('success', 'Le manga ' . $mangaName . ' à était ajouté !', 200);
    }

    public function insert(Request $request) {
        //  Je récupére tous les mangas dans le dossier mangas

        // TODO: $mangaName = $request->input(trim('pathManga')); Parcourir un dossier du serveur pour ajout

        $directories = Storage::directories('public/mangas/');
        $AllMangasNames = [];
        foreach ($directories as $manga) {
            $newManga = explode("/", $manga);
            if (!in_array($newManga[2], $AllMangasNames, true)) {
                $AllMangasNames[] = $newManga[2];
            }     
        }        
        
        $isMangaInsertInDatabase = [];
        foreach ($AllMangasNames as $newManga) {
            $manga = Mangas::firstOrCreate(
                ['manga_name' => $newManga],
                ['manga_cover' => $newManga . ".jpg",
                'manga_directory' => "/". $newManga,
                'manga_banner' => '/banner_default.jpg',
                'uploader_id' => Auth::user()->id,
                'created_at' => new \datetime()],
            );

            $lastMangaId = $manga->id;

            AdminTomesController::insert($newManga, $lastMangaId);
            
            if ($manga->exits == false) {
                $isMangaInsertInDatabase[] = $newManga;
            }
        }

        if ($isMangaInsertInDatabase != null) {
            // return redirect()->route('profile');
            return view('admin/form', [
                'newManga' => $isMangaInsertInDatabase
                ])->with('success', 'Les mangas ont était ajouté !', 200);
        } else {
            return back()->with('success', 'Les mangas sont déjà présent !', 200);
        }
    }


    /**
     * DELETE a  manga.
     *
     * @return App\Models\Mangas
     */
    public function delete($id)
    {
        // Je recherche si le manga existe dans la bdd via son id
        $manga = Mangas::find($id);
        // je vais chercher le nom du dossier
        $mangaDirectory = public_path() . '/assets/mangas/'.  $manga->manga_directory;

        // si le manga existe
        if ($manga) {
            // je vais chercher sur son répertoire existe
            if (File::exists($mangaDirectory)) {
            // si le répertoir existe je le supprime avec toutes ses dépendances (fichiers, sous dossier)
                File::deleteDirectory($mangaDirectory);       
            }else {
            // je retourne un message d'erreur
            return back()->with('error', 'Le dossier pour le manga  ' . $manga->manga_name . ' n\'éxiste pas !', 404);
            }
            // je supprime le manga de la bdd et tooutes ses données associés 
            $manga::destroy($id);
            // je retourne un message de succés
            // return back()->with($id . " supprimer", 200);
            return back()->with('success', 'Le manga ' . $manga->manga_name . ' à bien était supprimé !', 200);
        } else {
            // Je retourne un message d'erreur
            return back()->with('error', 'Le manga ' . $manga->manga_name . ' n\'éxiste pas !', 404);
        }

        
    }

}
