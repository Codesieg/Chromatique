<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Mangas;

class MangasController extends Controller
{
    /**
     * Show all the mangs in database.
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
    public function add()
    {
        // $title = $request->input('title');
        // $categoryId = $request->input('categoryId');
        // $completion = $request->input('completion');
        // $status = $request->input('status');
        
        // $newManga = new Mangas();
        // $newManga->manga_name = 'Bleach';
        // $newManga->manga_jacket = 'Bleach/bleach.jpg';
        // $newManga->author = 'Tite Kubo';
        // $newManga->synopsis = '';
        // $newManga->manga_banner = '';
        // $newManga->users_id = 1;

        // dump($newTask);

        $newManga = Mangas::create([
            'manga_name' => 'High School Of The Dead',
            'manga_jacket' => 'High School Of The Dead',
            'author' => 'Tite Kubo',
            'synopsis' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laborum corporis temporibus optio, aperiam ex accusantium.',
            'manga_banner' => '',
            'users_id' => '1',

        ]);
        // dump($newManga);
        $isInserted = $newManga->save();

        if ($isInserted) {
            return view('mangas/home', [
                'listMangas' =>  Mangas::all()
            ]);
        } else {
            return $this->sendEmptyResponse(500);
        } 
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
            return $this->sendJsonResponse($id . " supprimer", 200);
        } else {
            return $this->sendEmptyResponse(500);
        }
    }

}
