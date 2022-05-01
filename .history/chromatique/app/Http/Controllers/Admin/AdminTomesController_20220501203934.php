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
     * Show the forms to modify tome by id.
     *
     * @return App\Models\Mangas
     */
    public function form_edit($id)
    {
        $tome = Tomes::find($id);
        $mangaName = Mangas::find($tome->manga_id);
        // dd($mangaName);
        // Retourne le formulaire prés-rempli avec les données du manga
        return view('admin/tomes/edit', [
            'tome' => $tome,
            'mangaName' => $mangaName,
        ]);
    }

    /**
     * Modify the tome by id.
     *
     * @return App\Models\Mangas
     */
    public function edit($id, Request $request) {
        $tomeNumber = $request->input('tomeNumber');
        $mangaId = $request->input('mangaId');
        
        Tomes::where("id", $id)->update(
            ['manga_id'=> $mangaId, 'tome_number' => $tomeNumber],
            ['tome_number' => $tomeNumber,
            'manga_id' => $mangaId,
            'created_at' => new \datetime(),
            'updated_at' => new \datetime()],
            );
        
        $listManga = Mangas::all()->sortBy('manga_name');

        return view('admin/browse', [
            'listMangas' => $listManga,
        ]);
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

        $newMangaDirectory = $mangaDirectory[0]->manga_directory;
        
        // Création du nouveau repertoire 
        $tomeName = 'tome_'. $tomeNumber;
        Storage::disk('mangas')->makeDirectory($newMangaDirectory . '/' . $tomeName); 

        //  Ajout en bdd
        $newTome = Tomes::firstOrCreate(
            ['manga_id'=> $mangaId, 'tome_number' => $tomeNumber],
            ['tome_number' => $tomeNumber,
            'manga_id' => $mangaId,
            'created_at' => new \datetime(),
            'updated_at' => new \datetime()],
            );

        // Boucle sur les pages
            if($request->hasfile('pages'))
            {
                foreach ($request->file('pages') as $page) {
                    $pageFile = $newMangaDirectory . '/' . $tomeName . '/' . $page->getClientOriginalName();        

                Storage::disk('mangas')->putFileAs($newMangaDirectory . '/' . $tomeName, $page , $page->getClientOriginalName());

                    // Création des pages du tome :
                    Pages::firstOrCreate(
                        ['tome_id'=> $newTome->id, 'page_number' => $pageFile],
                        ['page_number' => $pageFile, //TODO:  Venir récupérer le numero de la page
                        'page_file' => $pageFile, 
                        'tome_id' => $newTome->id,
                        'created_at' => new \datetime(),
                        'updated_at' => new \datetime()],
                    );
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

        $manga = Mangas::find($tome->manga_id);
        $mangaDirectory = $manga->manga_directory;
    
        if ($tome) {

            $deleteTome = Storage::disk('mangas')->deleteDirectory($mangaDirectory . '/tome_' . $tome->tome_number);  

            if ($deleteTome == false) {
            // je retourne un message d'erreur
            return back()->with('error', 'Le dossier pour le tome  ' . $tome->tome_name . ' n\'éxiste pas !', 404);
            }

            // je supprime le tome de la bdd et tooutes ses données associés 
            $tome::destroy($id);
            // je retourne un message de succés
            return back()->with('success', 'Le tome ' . $tome->tome_name . ' à bien était supprimé !', 200);
        } else {
            // Je retourne un message d'erreur
            return back()->with('error', 'Le tome ' . $tome->tome_name . ' n\'éxiste pas !', 404);
        }

        
    }

}
