<?php

namespace App\Http\Controllers\Api;
use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
        $author = Author::all();
        return response()->json($author);
    }
}
