<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages_old extends Model
{
    use HasFactory;

    /**
     * Get the manga that owns the tome.
     */
    public function chapters()
    {
        return $this->belongsTo(Chapters::class);
    }
}
