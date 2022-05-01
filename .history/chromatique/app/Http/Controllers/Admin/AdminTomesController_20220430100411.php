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
        // Récupération des upload
        // $this->validate($request, [
        //         'pages' => 'required',
        //         'pages.*' => 'mimes:jpg,png'
        //         ]);

        $tomeNumber = $request->input('tomeNumber');
        $mangaId = $request->input('mangaId');
        
        // Récupération du répertoire du manga
        $mangaDirectory = Mangas::where('id', $mangaId)
                                    ->select('manga_directory')
                                    ->get();

        $mangaDirectory = $mangaDirectory[0]->manga_directory;
        
        // Création du nouveau repertoire 
        $tomeName = 'tome_'. $tomeNumber;
        Storage::disk('mangas')->makeDirectory($mangaDirectory[0]->manga_directory . '/' . $tomeName); 

        //  Ajout en bdd
        Tomes::firstOrCreate(
            ['manga_id'=> $mangaId, 'tome_number' => $tomeNumber[1]],
            ['tome_number' => $tomeNumber,
            'manga_id' => $mangaId,
            'created_at' => new \datetime(),
            'updqted_at' => new \datetime(),
            ]);

        // Boucle sur les pages
            if($request->hasfile('pages'))
            {
                foreach ($request->file('pages') as $page) {
                    dd($page);
                    // $pagePath = $mangaDirectory . '/' . $tomeName . '/' . $page->getClientOriginalName();        
                    // $pageNumber = explode('-', $pagePath);

                    $cover = Storage::disk('mangas')->putFileAs($mangaDirectory, $page , $page->getClientOriginalName());

                    // Création des pages du tome :
                    Pages::firstOrCreate(
                        ['tome_id'=> $lastTomeId, 'page_number' => $pagePath],
                        ['page_number' => $pagePath, //TODO:  Venir récupérer le numero de la page
                        'page_file' => $pagePath, 
                        'tome_id' => $lastTomeId,
                        'created_at' => new \datetime()],

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
            if (!in_array($tome[3], $AllNewTomes, true)) {
                $table = $newTome[3]; 
                $AllNewTomes[$table]["number"] = $newTome[3];                
            }     
            $allPagesForCover = Storage::disk('local')->allFiles('public/mangas/'. $newManga . '/' . $newTome[3]);
            foreach ($allPagesForCover as $cover) {
                $pagePath = explode("/", $cover);
                array_splice($pagePath, 0 , 2);
                $pagePath = implode("/", $pagePath);
                $AllNewTomes[$table]['cover'] = $pagePath;
            }
        }
        
        foreach ($AllNewTomes as $newTome) { 
                $tomeNumber = explode("_", $newTome['number']);
                $tome = Tomes::firstOrCreate(
                    ['manga_id'=> $lastMangaId, 'tome_number' => $tomeNumber[1]],
                    ['tome_number' => $tomeNumber[1],
                    'tome_cover' => $newTome['cover'],
                    'manga_id' => $lastMangaId,
                    'created_at' => new \datetime()],
                );
            
                $lastTomeId = $tome->id;
        
                // Boucle sur les pages
                $allPages = Storage::disk('local')->allFiles('public/mangas/'. $newManga . '/' . $newTome['number']);
                foreach ($allPages as $page) {
                    $pagePath = explode("/", $page);
                    array_splice($pagePath, 0 , 2);
                    $pagePath = implode("/", $pagePath);

                    Pages::firstOrCreate(
                        ['tome_id'=> $lastTomeId, 'page_number' => $pagePath],
                        ['page_number' => $pagePath, //TODO:  Venir récupérer le numero de la page
                        'page_file' => $pagePath, 
                        'tome_id' => $lastTomeId,
                        'created_at' => new \datetime()],
                    );
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
