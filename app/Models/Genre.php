<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //
    // ini untuk mengizinkan laravel mengirmikan 2 data ini yaut name, dan description, 
    // kalau ada data lain, tinggal kasih koma,
    //  ada 2 yaitu fillable dan guarded (di lindungin)
    protected $fillable = [
        "name", "description"
    ];
}
