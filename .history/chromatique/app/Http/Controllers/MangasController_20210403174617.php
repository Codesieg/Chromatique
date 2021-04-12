<?php

namespace App\Http\Controllers;

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
        $listManga = 
        dd($listManga)
        return view('home', [
            'listMangas' => Mangas::all()
        ]);
    }
    
    /**
     * Show the mangas by id.
     *
     * @return App\Models\Mangas
     */
    public function read($id)
    {
        return view('details', [
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
        return view('add', [
            'manga' => Mangas::find($id)
        ]);
    }

    /**
     * Add a new manga.
     *
     * @return App\Models\Mangas
     */
    public function add(Request $request)
    {
        $title = $request->input('title');
        $categoryId = $request->input('categoryId');
        $completion = $request->input('completion');
        $status = $request->input('status');
        
        $newManga = new Mangas();
        $newManga->title = $title;
        $newManga->category_id = $categoryId;
        $newManga->completion = $completion;
        $newManga->status = $status;

        // dump($newTask);

        $isInserted = $newManga->save();

        if ($isInserted) {
            return $this->sendJsonResponse($newManga, 200);
        } else {
            return $this->sendEmptyResponse(500);
        } 
    }

    /**
     * Add a new manga.
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
