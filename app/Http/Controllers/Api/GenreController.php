<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;        // ini yang akan mengambil request, ada semua controller, request nya akan kita gunakan untuk stroe data
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Resource_;

class GenreController extends Controller
{
    public function index(){
        $genres = Genre::all();

        
        // jika data nya tidak ada, pesan nya seperti ini, yang dibedain message nya
        if($genres->isEmpty()){
            return response()->json([
                "status" => true,
                "message" => "GET ALL Resource nyaa",
                "data" => $genres
            ] , 200);
        }
        return response()->json([
            "status" => true,
            "message" => "GET ALL Resource nyaa",
            "data" => $genres
        ] , 200);
    }


 

        public function store(Request $request)
        {

            //membuat validasi 
            $validator = Validator::make($request->all(),[
                "name" => "required|string",
                "description" => "required|string"
            ]);

            // melakukan cek data yang bermasalah
            if($validator ->fails()){
                return response()->json([
                    "success" => false,
                    "message" => $validator ->errors()
                ], 422);
            }
            //membuat data genre
            $genre= Genre::create([
                "name" => $request->name,
                "description" => $request->description

            ]);

            // memberi pesan berhasil
            return response()-> json([
                "success" => true,
                "message" => "Resource added Succesfully nya",
                "data" => $genre
            ], 201);
        }



        public function show(string $id){
            $genre = Genre::find($id);
         
           
            // tugas : tambahkan error handling ketika id yang dicari tidak ditemukan
            // success = false
            // message = "Resource not fonud"
            // error 404

            if (!$genre) {
                return response()->json([
                    "success" => false, 
                    "message" => "Resource not fonud"
                ], 404);
            }
               
            return response()->json([
                "success" => true,
                "message" => "Get detail Resource",
                "data" => $genre
            ], 200);
        
        }

        
}





