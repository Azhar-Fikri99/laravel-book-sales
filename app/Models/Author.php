<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //

    // protected $fillable = []     -> protected gak bisa diubah, kalau public bisa di akses dari manapun
    protected $fillable = [
        "name", "photo", "bio"
    ];
}
