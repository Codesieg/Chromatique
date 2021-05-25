<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tomes_old extends Model
{
    use HasFactory;

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
}
