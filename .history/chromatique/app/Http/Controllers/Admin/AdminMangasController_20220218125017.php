<?php

namespace App\Http\Controllers\Admin;

use App\Models\Users;
use App\Models\Mangas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        // il faut récupérer le nom d'utilisateur de la session en cours plutôt que de lister touts les uploaders
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

    // Venir récup les dossier sur un emplacement quelconque et enregistrer cet emplacement en BDD
    // controler de ne pas créer des dossiers et des fichiers en  double.
    // 1 - Je viens dans un dossier précis stocker tous les managas éxistant, Avoir une conf pour indiquer où est le dossier des mangas
    // 2 - Je cré une boucle qui enregistre en bdd l'emplacement l'url de chaque dossier / sous dossier et fichier
    
    public function add(Request $request)
    {
        // On récupére le nom du manga et on supprime les espaces vide en debut et fin
        $mangaName = $request->input(trim('mangaName'));
        $author = $request->input('author');
        $synopsis = $request->input('synopsis');
        $uploaderId = $request->input('uploaderId');

        //Récupération de la couverture du manga et verification de son type
        $this->validate($request, [
                'mangaCover' => 'required',
                'mangaCover.*' => 'mimes:jpg,png'
        ]);

        // Ajout de la couverture du manga
        if($request->hasfile('mangaCover'))
        {
            // Récupération du fichier uploadé
            $cover = $request->file('mangaCover');

            // On prend le nom du manga puis on renomme le fichier uploadé avec 
            // son nom et on ajoute à l'extension du fichier uploadé le chemin du fichier ex : one_piece/one_piece.jpg

            // On sépare la string pour reformatter le text et on passe tout en minuscule
            $mangaDirectory = strtolower($mangaName);
            $mangaDirectory =  str_replace(' ', '_', $mangaName );

            // On attribue le même nom au fichier de la cover
            $coverName = $mangaDirectory;

            // On définit le chemin du fichier cover pour la BDD
            $coverPath = '/' . $coverName . '.' . $cover->extension();

            // On déplace le fichier dans le répertoire assets du dossier public
            // Chemin vers le fichier manga
            $mangaPath = $mangaDirectory .'/'. $coverName . '.' . $cover->extension();
            
            // Chemin vers le dossier public
            $publicPath = public_path('assets/mangas'). $mangaDirectory;
            $cover->move($publicPath, $mangaPath);  
        }



        $file= new Mangas();
        $file->manga_name = ucfirst($mangaName);
        $file->manga_cover = ucfirst($coverPath);
        $file->manga_directory = '/' . $mangaDirectory;
        $file->manga_author = $author;
        $file->manga_synopsis = $synopsis;
        $file->uploader_id = $uploaderId ;
        $file->created_at = new \datetime();
        $file->save();

        // return redirect()->route('profile');
        return back()->with('success', 'Le manga ' . $mangaName . ' à était ajouté !', 200);
    }

    public function insert(Request $request) {
        //  Je récupére tous les mangas dans le dossier mangas
        $allFiles = Storage::disk('local')->allFiles('public/mangas/');
        // dump($allFiles);
        // Je doit séparer chacun manga par dossier en fonction de leur nom et stocker le nom en bdd.
        // Lorsque j'ai récupérer les noms de chaque manga, je peut passé celui-ci dans ma variable de ma fonction readManga dans une eutre methode (celle de lecture)

        // $mangaName = "Alice_in_borderland";
        // $files = readManga();
        // function readManga($mangaName) {
        //     return $files;
        // }
        $AllMangasNames = [];

        foreach ($allFiles as $manga) {
            $NewManga = explode("/", $manga);
            // dump($NewManga[2]);
            if (in_array($NewManga[2], $AllMangasNames, true)) {
                echo "Manga déja présent </br>";
            } else {
                $AllMangasNames[] = $NewManga[2];
            }     
        }
        // dump($AllMangasNames);
        
        
        foreach ($AllMangasNames as $mangaName) {
            // $NewMangaName = explode("_", $mangaName);
            // $mangaDirectory = explode("/", $NewManga[0]);
            // dd($NewMangaName, $allFiles);
            // $mangaDirectory = strtolower($mangaName);
            // $mangaDirectory =  str_replace('_', '', $mangaName ); // Amélioré le tout avec une regex afin de prendre en compte plusieurs format
            $file = Mangas::firstOrCreate(
                ['manga_name' => $mangaName ],
                ['manga_cover' => $mangaName,
                'manga_directory' => $mangaName,
                'created_at' => new \datetime()],
            );


        }


// Pour chaque dossier parents -> je crée un nouveau manga en verifiant qu'il n'est pas existant
// Pour chaque sous dossier je crée un nouveau tome en verifiant qu'il n'est pas existant
// Pour chaque fichier dans le sous dossier j'enregistre chaques pages en vérifiant qu'elle n'est pas existante

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
