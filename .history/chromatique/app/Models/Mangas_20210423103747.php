<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mangas extends Model
{
    use HasFactory;
    protected $fillable = [
        'manga_name',
        'manga_jacket',
        'author',
        'synopsis',
        'manga_banner',
        'manga_directory',
        'home_order',
        'users_id',
        'chapter_id',

    ];

    /**
     * Get the tomes for the manga.
     */
    public function tomes()
    {
        return $this->hasMany(Tomes::class);
    }

}
