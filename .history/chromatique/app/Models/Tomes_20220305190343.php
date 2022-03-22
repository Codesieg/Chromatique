<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tomes extends Model
{
    use HasFactory;
    protected $fillable = [
        'tome_number',
        'tome_cover',
        'manga_id',

    ];
    /**
     * Get the chapters for the manga.
     */
    public function chapters()
    {
        return $this->hasMany(Chapters::class);
    }

    /**
     * Get the manga that owns the tome.
     */
    public function mangas()
    {
        return $this->belongsTo(Mangas::class);
    }

    public static function getTomesByManga($id)
    {
        $listTomes = DB::table('mangas')
                ->select('tomes.*', 'mangas.manga_directory',)
                ->leftJoin('tomes', 'mangas.id', '=', 'tomes.manga_id')
                ->where('mangas.id', $id)
                ->orderBy('tome_number')
                ->distinct()
                ->get();
        return $listTomes;
    }

    public static function getPagesByTome($id)
    {
        $listPages = DB::table('mangas')
            ->select('pages.*',)
            ->leftJoin('tomes', 'mangas.id', '=', 'tomes.manga_id')
            ->leftJoin('chapters', 'tomes.id', '=', 'chapters.tome_id')
            ->leftJoin('pages', 'chapters.id', '=', 'pages.chapter_id')
            ->where('manga_id',$id)
            ->distinct()
            ->get();
        return $listPages;
    }

    public static function getNameByTomeNumber($id)
    {
        $listPages = DB::table('tomes')
            ->select('pages.*',)
            ->leftJoin('mangas', 'mangas.id', '=', 'tomes.manga_id')
            ->where('manga_id',$id)
            ->distinct()
            ->get();
        return $listPages;
    }


}
