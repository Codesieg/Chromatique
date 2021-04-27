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
        'users_id',
    ];

        /**
     * Get the tomes for the manga.
     */
    public function tomes()
    {
        return $this->hasMany(Tomes::class);
    }

        /**
     * Get the manga that owns the tome.
     */
    public function mangas()
    {
        return $this->belongsTo(Mangas::class);
    }
}
