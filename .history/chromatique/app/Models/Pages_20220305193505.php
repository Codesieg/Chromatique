<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_number',
        'page_file',
        'tome_id',

    ];
    /**
     * Get the manga that owns the tome.
     */
    public function chapters()
    {
        return $this->belongsTo(Chapters::class);
    }
}
