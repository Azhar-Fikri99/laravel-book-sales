<?php

namespace App\Http\Controllers\Api;
use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $books = Book::all();
        // BOOK:all()
        return response()->json($books);
    }
}

