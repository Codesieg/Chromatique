<?php

namespace App\Http\Controllers;

use App\Models\Pages;
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
     * Add a new tome. 
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
        // Récupération des entrées du formulaires
        $this->validate($request, [
                'tomeJacket' => 'required',
                'tomeJacket.*' => 'mimes:jpg,png'
                ]);
        $this->validate($request, [
            'pages' => 'required',
            'pages.*' => 'mimes:jpg,png'
        ]);

        $tomeName = $request->input('tomeName');
        $tomeNumber = $request->input('tomeNumber');
        $mangaId = $request->input('mangaId');
        

        // Récupération du répertoir du manga
        $mangaDirectory = Mangas::where('id', $mangaId)
                            ->get();

        foreach ($mangaDirectory as $manga) {
            $mangaDirectory = $manga->manga_directory;
            // dd($mangaDirectory);
        }

        // à la création d'un nouveau tome, il faut créer un nouveau dossier (tomme xx)
        // Récupérer le nom du fichier et le renomer
        if($request->hasfile('tomeJacket'))
            {
                $jacket = $request->file('tomeJacket');
                $jacketName = '/' . $tomeName . '/' . $tomeName . '.' . $jacket->extension();        
                $jacket->move(public_path().'/assets/mangas/'. $mangaDirectory . '/'. ucfirst($tomeName), $jacketName);
            }
        // Boucle sur les pages
            if($request->hasfile('pages'))
            {
                foreach ($request->file('pages') as $page) {
                    // dump($page->getClientOriginalName());
                    $pageName = $page->getClientOriginalName();        
                    $page->move(public_path().'/assets/mangas/'. $mangaDirectory . '/'. ucfirst($tomeName), $pageName);
                    $pageNumber = explode('-', $pageName);
                    dd($pageNumber);
                       // Création des pages du page :
                    $page = new Pages();
                    $page->page_name = $pageName;
                    $page->page_number = $pageNumber[1];
                    // faire un explode sur le nom du fichier
                    $page->mangas_id = $mangaId;
                    $page->chapters_id = $pageNumber[0];
                    $page->created_at = new \datetime();
                    $page->save();

                }
            
            }

        // Création du tome :
        $tome = new Tomes();
        $tome->tome_name = $tomeName;
        $tome->tome_jacket = ucfirst($jacketName);
        $tome->tome_number = $tomeNumber;
        $tome->mangas_id = $mangaId;
        $tome->created_at = new \datetime();
        $tome->save();

        // Création des pages du page :
        // $page = new Pages();
        // $page->page_name = $pageName;
        // $page->page_number = $pageNumber;
        // faire un explode sur le nom du fichier
        // $page->mangas_id = $mangaId;
        // $page->chapters_id = $chaptersId;
        // $page->created_at = new \datetime();
        // $page->save();


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
