<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Author::create([
            'name' => 'J.K.Rowling',
            'photo' => 'jkrowling.png',
            'bio' => 'Penulis Inggris di balik seri fantasy Harry Pother yang mendunia'
        ]);

        Author::create([
            'name' => 'Ari Aster',
            'photo' => 'ari.png',
            'bio' => 'asal Amerika Serikat yang dikenal lewat film Hereditary (2018), Midsommar (2019),'
        ]);

        Author::create([
            'name' => 'Barbara Cartland',
            'photo' => 'barbara.png',
            'bio' => ' Penulis Inggris yang dikenal sebagai Ratu Romantis. Ia menulis novel-novel romantis kontemporer dan sejarah.'
        ]);

        Author::create([
            'name' => 'J.K.Rowling',
            'photo' => 'jkrowling.png',
            'bio' => 'Penulis Inggris di balik seri fantasy Harry Pother yang mendunia.'
        ]);

        Author::create([
            'name' => 'Clyde Brion Davis',
            'photo' => 'Clyde.png',
            'bio' => 'penulis novel The Anointed yang diadaptasi menjadi film Adventure (1946)..'
        ]);
    }
}
