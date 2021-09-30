<?php

namespace App\Models;

class Manga
{

    private $mangas = [
        [
            'id' => 1,
            'name' => 'One piece',
            'image' => 'cover1.jpg',
        ],
        [
            'id' => 2,
            'name' => 'Highschool of te dead',
            'image' => 'cover2.jpg',
        ],
        [
            'id' => 3,
            'name' => 'Hunter X Hunter',
            'image' => 'cover3.jpg',
        ],
        [
            'id' => 4,
            'name' => 'Naruto',
            'image' => 'cover4.jpg',
        ],
        [
            'id' => 5,
            'name' => 'Demon Slayer',
            'image' => 'cover5.jpg',
        ],
        [
            'id' => 6,
            'name' => 'Dragon Ball Super',
            'image' => 'cover6.jpg',
        ],
    ];

    public function getManga()
    {
        return $this->mangas;
    }

    public function getOneManga(int $id): ?array
    {
        if (isset($this->mangas[$id])) {
            return $this->mangas[$id];
        } else {
            return null;
        }
    }
}
