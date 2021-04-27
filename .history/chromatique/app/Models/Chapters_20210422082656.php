<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapters extends Model
{
    use HasFactory;

            /**
     * Get the pages for the manga.
     */
    public function pages()
    {
        return $this->hasMany(Pages::class);
    }

        /**
     * Get the tome that owns the chapters.
     */
    public function tomes()
    {
        return $this->belongsTo(Tomes::class);
    }
}
