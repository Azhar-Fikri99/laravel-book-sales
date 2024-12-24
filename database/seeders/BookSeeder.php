<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            //
            // 

            // $table->id();
            // $table->string('title');
            // $table->text('description')->nullable();
            // $table->decimal('price', 10, 2);
            // $table->integer('stock');
            // $table->string('cover_photo')->nullable();
            // $table->unsignedBigInteger('genre_id');
            // $table->unsignedInteger('author_id');
            // $table->timestamps();
            Book::create([
                'title' => 'Harry Pother and The Sorcener',
                'description' => 'An orphaned boy enrolls in a school of wizardy, where he learns',
                'price' => 10.59,
                'stock' => 50,
                'cover_photo' => "harry_potther.jpg",
                'genre_id' => 1,
                'author_id' => 1
            ]);

            Book::create([
                'title' => 'The Conjuring',
                'description' => ' supernatural horror film directed by James Wan. It is based on the real-life paranormal investigations of Ed and Lorraine Warren',
                'price' => 44.12,
                'stock' => 30,
                'cover_photo' => "Conjuring.jpg",
                'genre_id' => 2,
                'author_id' => 2
            ]);

            Book::create([
                'title' => 'Winter in Tokyo',
                'description' => 'a unique and beautiful experience, offering a mix of cold weather and festive charm. The season typically spans from December to February',
                'price' => 77.32,
                'stock' => 12,
                'cover_photo' => "winter_tokyo.jpg",
                'genre_id' => 3,
                'author_id' => 3
            ]);

            Book::create([
                'title' => 'The Chronicles of Narnia',
                'description' => 'a series of seven fantasy novels written by British author C.S. Lewis. The books are set in the magical land of Narnia, a world inhabited by talking animals',
                'price' => 88.2,
                'stock' => 9,
                'cover_photo' => "Narnia.jpg",
                'genre_id' => 4,
                'author_id' => 4
            ]);

            Book::create([
                'title' => 'The Lord of the Rings',
                'description' => 'a high-fantasy epic novel written by English author J.R.R. Tolkien. Originally published in three volumes between 1954 and 1955',
                'price' => 77.2,
                'stock' => 3,
                'cover_photo' => "lord_of_the_ring.jpg",
                'genre_id' => 5,
                'author_id' => 5
            ]);
    }
}
