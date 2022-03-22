<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pages;
use App\Models\Tomes;
use App\Models\Mangas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class AdminTomesController extends Controller
{
    /**
     * Show all the tomes in database.
     *
     * @return App\Models\Tomes
     */
    public function browse()
    {
        $listTomes = Tomes::all()->sortBy('tome_number');
        dump($listTomes);

        return view('admin/tomes/detail', [
            'listTomes' => $listTomes
        ]);
    }
    
    /**
     * Show the tome by id.
     *
     * @return App\Models\Tomes
     */
    public function read($id)
    {
        $listTomes = Tomes::where('manga_id', $id)->orderBy('tome_number')->get();
        $mangaName = Mangas::find($id);


        return view('admin/tomes/detail', compact('listTomes', 'mangaName'));
    }


    /**
     * Modify the tome by id.
     *
     * @return App\Models\Tomes
     */
    public function edit($id)
    {
        $mangaLists = Mangas::all()->sortBy('manga_name');
        $mangaName = Mangas::find($id);
        $tome = Tomes::find($id);

        return view('admin/tomes/edit', compact('mangaLists', 'tome', 'mangaName'));
    }

    /**
     * Redirect to page for add a new tome. 
     * 
     *
     * @return void
     */
    public function form($id)
    {
        $mangasLists = Mangas::where('id', $id)
        ->get();
        // dd($mangasLists);

        return view('admin/tomes/form', 
        ['mangasLists' => $mangasLists]
    );
    }

    /**
     *Add a new tome.
     *
     * @return App\Models\Tomes
     */
    public function add(Request $request)
    {
        // Récupération de l'uploade de la cover
        $this->validate($request, [
                'tomePath' => 'required',
                'tomePath.*' => 'mimes:jpg,png'
                ]);
        // Récupération des uploades des pages
        $this->validate($request, [
            'pages' => 'required',
            'pages.*' => 'mimes:jpg,png'
        ]);

        $tomeNumber = $request->input('tomeNumber');
        $mangaId = $request->input('mangaId');
        

        // Récupération du répertoire du manga
        $mangaDirectory = Mangas::where('id', $mangaId)
                            ->get();

        foreach ($mangaDirectory as $manga) {
            $mangaDirectory = $manga->manga_directory;
        }

        // à la création d'un nouveau tome, il faut créer un nouveau dossier (tomme xx)
        // Récupérer le nom du fichier et le renomer
        if($request->hasfile('tomePath'))
            {
                // Récupération du fichier uploadé
                $cover = $request->file('tomePath');

                // On attribue le nom du tome pour la bdd et la création du dossier
                $tomeName = 'tome_'. $tomeNumber;

                // On définit le chemin du fichier cover pour la BDD
                $coverPath = '/' . $tomeName . '/' . $tomeName . '.' . $cover->extension();  
                // Chemin vers le dossier public
                $publicPath = public_path() . '/assets/mangas/'. $mangaDirectory. '/'. $tomeName;      
                $cover->move($publicPath, $coverPath);

                  // Création du tome :
        $tome = new Tomes();
        $tome->tome_path = $coverPath;
        $tome->tome_number = $tomeNumber;
        $tome->manga_id = $mangaId;
        $tome->created_at = new \datetime();
        $tome->save();
        $lastTomeId = $tome->id;
            }
        // Boucle sur les pages
            if($request->hasfile('pages'))
            {
                foreach ($request->file('pages') as $page) {
                    // dump($page->getClientOriginalName());
                    $pagePath = $mangaDirectory . '/' . $tomeName . '/' . $page->getClientOriginalName();        
                    $page->move(public_path().'/assets/mangas/'. $mangaDirectory . '/'. ucfirst($tomeName), $pagePath);
                    $pageNumber = explode('-', $pagePath);
                    // dd(substr($pageNumber[1], 0, 2));
                       // Création des pages du tome :
                    $page = new Pages();
                    $page->page_file = $pagePath;
                    $page->page_number = substr($pageNumber[1], 0, 2);
                    // faire un explode sur le nom du fichier
                    $page->tome_id = $lastTomeId;
                    // $page->chapters_id = $pageNumber[0];
                    $page->created_at = new \datetime();
                    $page->save();

                }
            
            }

        return redirect()->route('admin_read_tome', ['id' => $mangaId] );
    }

        /**
     *Add a new tome.
     *
     * @return App\Models\Tomes
     */
    public static function insert($newManga, $lastMangaId)
    {
        $directories = Storage::directories('public/mangas/' . $newManga);
        
        $AllNewTomes = [];
        foreach ($directories as $tome) {
            $newTome = explode("/", $tome);
            // dd($newTome);
            if (in_array($tome[3], $AllNewTomes, true)) {
                echo "Tome déja présent </br>";
            } else {
                $AllNewTomes[] = $newTome[3];                
            }     
        }
        
        foreach ($AllNewTomes as $newTome) { 
            $tomeNumber = explode("_", $newTome);

            $tome = Tomes::firstOrCreate(
                ['manga_id'=> $lastMangaId, 'tome_number' => $tomeNumber[1]],
                ['tome_number' => $tomeNumber[1],
                // 'tome_cover' => $tomNumber[1],
                'manga_id' => $lastMangaId,
                'created_at' => new \datetime()],
            );
            
            $lastTomeId = $tome->id;
        
            // Boucle sur les pages
            $allPages = Storage::disk('local')->allFiles('public/mangas/'. $newManga . "/" . $newTome);
            // dd($allPages, $newTome);
            // $pages = array_shift($allPages);
            // dd($allPages, $pages);
            foreach ($allPages as $page) {
                $pageNumber = explode("/", $page);

                $pageNumber = implode("/", $page);
                // dd($allPages);
                Pages::firstOrCreate(
                    ['tome_id'=> $lastTomeId, 'page_number' => $tomeNumber[1]],
                    ['page_number' => $pageNumber[4],
                    'page_file' => substr($page, 0, 15),
                    'tome_id' => $lastTomeId,
                    'created_at' => new \datetime()],
                );
            // ajouter la page du tome ici


            }
            

        }



    }

/**
     * DELETE a  tome.
     *
     */
    public function delete($id)
    {
        // Je recherche si le tome existe dans la bdd via son id
        $tome = Tomes::find($id);

        //je récupére le répertoire du manga correspondant au tome
        $manga = Mangas::find($tome->manga_id);
        $mangaDirectory = $manga->manga_directory;
        //  Je fait un explode sur le chemin du tome afin de récupérer uniquement le nom du dosier
        $tomePath = explode('/', $tome->tome_path);

        // je renseigne le chemein du dossier
        $tomeDirectory = public_path() . '/assets/mangas' .  $mangaDirectory . '/'. $tomePath[1] ;

        // si le tome existe
        if ($tome) {
            // je vais chercher si son répertoire existe
            if (File::exists($tomeDirectory)) {
            // si le répertoire existe je le supprime avec toutes ses dépendances (fichiers, sous dossier)
                File::deleteDirectory($tomeDirectory);       
            }else {
            // je retourne un message d'erreur
            return back()->with('error', 'Le dossier pour le tome  ' . $tome->tome_name . ' n\'éxiste pas !', 404);
            }
            // je supprime le tome de la bdd et tooutes ses données associés 
            $tome::destroy($id);
            // je retourne un message de succés
            // return back()->with($id . " supprimer", 200);
            return back()->with('success', 'Le tome ' . $tome->tome_name . ' à bien était supprimé !', 200);
        } else {
            // Je retourne un message d'erreur
            return back()->with('error', 'Le tome ' . $tome->tome_name . ' n\'éxiste pas !', 404);
        }

        
    }

}
