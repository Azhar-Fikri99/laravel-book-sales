<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Genre::create([
            'name' => 'Fiksi',
            'description' => 'Karaya Imajinatif dalam bentuk prosea'
        ]);

        // membuat 5 data, kita tinggal copy aja

        Genre::create([
            'name' => 'Horror',
            'description' => 'Film Jump Scare'
        ]);

        Genre::create([
            'name' => 'Romance',
            'description' => 'Berhubungan dengan Percintaaan'
        ]);

        

        Genre::create([
            'name' => 'Fantasy',
            'description' => 'Genre fantasi merujuk pada cerita yang mengandung unsur-unsur yang tidak ada di dunia nyata, seperti sihir, makhluk mitologi, dunia paralel, atau kemampuan luar biasa yang melampaui hukum'
        ]);

        

        Genre::create([
            'name' => 'Adventure',
            'description' => ' biasanya berfokus pada perjalanan dan pencarian, di mana tokoh utama berhadapan dengan berbagai tantangan atau bahaya dalam usaha mereka mencapai suatu tujuan.'
        ]);
    }
}
