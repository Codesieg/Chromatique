<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mangas extends Model
{
    use HasFactory;
    protected $fillable = [
        'manga_name',
        'manga_cover',
        'author',
        'synopsis',
        'manga_banner',
        'manga_directory',
        'manga_home_order',
        'uploader_id',
    ];

    /**
     * Get the tomes for the manga.
     */
    public function tomes()
    {
        return $this->hasMany(Tomes::class);
    }

}
