<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mangas extends Model
{
    use HasFactory;
    protected $fillable = [
        'manga_name',
        'manga_jacket'
        'author',
        'synopsis',
        'manga_banner',
        'users_id',
    ];
}
