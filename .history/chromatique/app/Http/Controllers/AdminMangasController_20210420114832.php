<?php

namespace App\Http\Controllers;

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
        $uploaderList = User::All();
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
        // $mangaJacket = $request->input('mangaJacket');
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

            $jacket->move(public_path().'/storage/mangas/'. ucfirst($mangaName), $name);  
        }

        $file= new Mangas();
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
