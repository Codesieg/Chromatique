<?php

namespace App\Providers;

use App\Models\Mangas;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {        
        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {

        $listManga = Mangas::select('id', 'manga_name')->get();

        $listMangaName = [];
        foreach ($listManga as $manga) {
            $listMangaName[] = str_replace(array("_", "'", "-"), ' ', $manga->manga_name);
        }
dd($listMangaName);
            $view->with('listMangasName', $listMangaName);
        });
    }
}
