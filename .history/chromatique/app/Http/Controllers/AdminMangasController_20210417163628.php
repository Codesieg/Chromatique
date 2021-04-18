<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mangas;

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
        
        
        // $newManga = new Mangas();
        // $newManga->manga_name = 'Bleach';
        // $newManga->manga_jacket = 'Bleach/bleach.jpg';
        // $newManga->author = 'Tite Kubo';
        // $newManga->synopsis = '';
        // $newManga->manga_banner = '';
        // $newManga->users_id = 1;

        // dump($newTask);

        // $newManga = Mangas::create([
        //     'manga_name' => 'High School Of The Dead',
        //     'manga_jacket' => 'High School Of The Dead',
        //     'author' => 'Tite Kubo',
        //     'synopsis' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laborum corporis temporibus optio, aperiam ex accusantium.',
        //     'manga_banner' => '',
        //     'users_id' => '1',

        // ]);
        // dump($newManga);
        // $isInserted = $newManga->save();

        // if ($isInserted) {
        //     return view('admin/browse', [
        //         'listMangas' =>  Mangas::all()
        //     ]);
        // } else {
        //     return $this->sendEmptyResponse(500);
        // } 

        return view('admin/add');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $mangaName = $request->input('mangaName');
        $mangaJacket = $request->input('mangaJacket');
        $author = $request->input('author');
        $synopsis = $request->input('synopsis');
        $userId = $request->input('synopsis');


        $this->validate($request, [
                'filenames' => 'required',
                'filenames.*' => 'mimes:jpg,png'
        ]);


        if($request->hasfile('filenames'))
         {
            foreach($request->file('filenames') as $file)
            {
                $name = time().'.'.$file->extension();
                $file->move(public_path().'/assets/mangas/', $name);  
                $data[] = $name;  
            }
         }


         $file= new Mangas();
         $file->manga_name = json_encode($data);
         $file->manga_jacket = $mangaJacket;
         $file->author = $author;
         $file->synopsis = $synopsis;
         $file->users_id = $userId ;
         $file->createdAt = new \datetime();
         $file->save();


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
            return $this->sendJsonResponse($id . " supprimer", 200);
        } else {
            return $this->sendEmptyResponse(500);
        }
    }

}
