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
        $listManga = Mangas::select('id', 'manga_name')->get();
        
        $listMangaName = [];
        foreach ($listManga as $manga) {
            $listMangaName[] = str_replace(array("_", "'", "-"), ' ', $manga->manga_name);
        }

        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            $view->with('listMangasName', Mangas::all()->sortBy('manga_name'));
        });
    }
}