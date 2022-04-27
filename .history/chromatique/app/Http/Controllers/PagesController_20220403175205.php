<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PagesController extends Controller
{
    /**
     * Show all the page of a tome for a page in database.
     *
     * @return App\Models\Pages
     */
    public function browse()
    {

        // $listPages = Pages::where('chapters_id', $id)
        // // ->leftJoin('', 'users.id', '=', 'posts.user_id')
        // ->get();

        // // dd($listPages);
        // return view('pages/browse', ['listPages' => $listPages]);
    }

    /**
     * Show all the tomes  from a page in database.
     *
     * @return App\Models\Tomes
     */
    public static function read($id)
    {
        $listPages = DB::table('pages')
            ->select('pages.*',)
            ->where('pages.tome_id', $id)
            ->orderBy('page_file')
            ->distinct()
            ->get();

        // dump($listPages);

        return view(
            'pages/browse',
            compact('listPages',)
        );
    }

    /**
     * DELETE a  page.
     *
     * @return App\Models\Pages
     */
    public function delete($id)
    {
        // Je recherche si le page existe dans la bdd via son id
        $page = Pages::find($id);
        // je vais chercher le nom du dossier
        $pageDirectory = public_path() . '/assets/mangas/pages/' .  $page->page_directory;

        // si le page existe
        if ($page) {
            // je vais chercher sur son répertoire existe
            if (File::exists($pageDirectory)) {
                // si le répertoir existe je le supprime avec toutes ses dépendances (fichiers, sous dossier)
                File::deleteDirectory($pageDirectory);
            } else {
                // je retourne un message d'erreur
                return back()->with('error', 'La page  ' . $page->page_name . ' n\'éxiste pas !', 404);
            }
            // je supprime le page de la bdd et tooutes ses données associés 
            $page::destroy($id);
            // je retourne un message de succés
            // return back()->with($id . " supprimer", 200);
            return back()->with('success', 'La page ' . $page->page_name . ' à bien était supprimé !', 200);
        } else {
            // Je retourne un message d'erreur
            return back()->with('error', 'La page ' . $page->page_name . ' n\'éxiste pas !', 404);
        }
    }
}
