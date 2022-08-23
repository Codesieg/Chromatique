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
                'mangaBanner' => 'required',
                'mangaCover.*' => 'mimes:jpg,png'
        ]);
            // Ajout de la couverture du manga
            if($request->hasfile('mangaCover'))
            {
                $formatName = str_replace(' ', '_', $mangaName);
                $coverName = $formatName . '.' . $request->file('mangaCover')->extension();

                // Récupération du fichier uploadé            
                $cover = Storage::disk('mangas')->putFileAs($formatName, $request->file('mangaCover'), $coverName);

                $formatBanner = str_replace(' ', '_', $mangaName);
                $bannerName = $formatBanner . '_banner'. '.' . $request->file('mangaCover')->extension();

                // On enregistre le manga  dans le dossier mangas de storage/app
                $mangaBanner = Storage::disk('mangas')->putFileAs($formatBanner, $request->file('mangaBanner'), $bannerName);

                // On sépare la string pour reformatter le text et on passe tout en minuscule
                $mangaDirectory = strtolower($mangaName);
                $mangaDirectory =  str_replace(' ', '_', $mangaName );

                // On attribue le même nom au fichier de la cover
                $mangaCover = explode('/', $cover);

        Mangas::firstOrCreate(
            ['manga_name' => $mangaName],
            ['manga_cover' => $mangaCover[1],
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
        // $mangaDirectory = public_path() . '/assets/mangas/'.  $manga->manga_directory;
        // $mangaDirectory = Storage::disk('mangas');
// dd($mangaDirectory);
        // si le manga existe
        if ($manga) {
            // je vais chercher si son répertoire existe
            // if (File::exists(Storage::disk('mangas'))) {
            // si le répertoir existe je le supprime avec toutes ses dépendances (fichiers, sous dossier)
                // File::deleteDirectory($mangaDirectory);  
                // dd($manga);
                // Storage::disk('mangas')->delete($manga->manga_banner);   
                $deleteManga = Storage::disk('mangas')->deleteDirectory($manga->manga_directory);  
                dd($manga->manga_directory, $deleteManga);
            // }else {
            // // je retourne un message d'erreur
            // return back()->with('error', 'Le dossier pour le manga  ' . $manga->manga_name . ' n\'éxiste pas !', 404);
            // }
            // je supprime le manga de la bdd et toutes ses données associés 
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
