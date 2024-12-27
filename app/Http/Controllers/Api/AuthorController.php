<?php

namespace App\Http\Controllers\Api;
use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index(){
        $author = Author::all();
        return response()->json($author);
    }

    public function store(Request $request)
        {

            //1 . membuat validasi 
            $validator = Validator::make($request->all(),[
                "name" => "required|string|max:255",
                // foto nya bebas, nanti extensi nya yang mau ke sini
                "photo" => "required|image|mimes:jpeg,png,gif,svg|max:2048",
                "bio" =>  "nullable|string"
            ]);

            // 2. melakukan cek data yang bermasalah
            if($validator->fails()){
                return response()->json([
                    "success" => false,
                    "message" => $validator ->errors()
                ], 422);
            }

            // 3. upload image
            // supaya gambar nya masuk ke storage
            $image = $request->file('photo');
            $image->store('authors', 'public');         // suapa ya nanti file nya di simpan larave, di bagain folder storage, 



            // 4. insert data
            $author = Author::create([
                "name" => $request->name,
                // "photo" => $image,        // kalau seperti ini gambar nya ada yang sama akan di timpa 
                "photo" => $image->hashName(), 
                "bio" => $request-> bio
            ]);


            //5. return response

            // memberi pesan berhasil
            return response()->json([
                "success" => true,
                "message" => "Resource added Succesfully nya",
                "data" => $author
            ], 201);
        }

        

        
        public function show(string $id){
            $author = Author::find($id);
         
           
            // tugas : tambahkan error handling ketika id yang dicari tidak ditemukan
            // success = false
            // message = "Resource not fonud"
            // error 404


            if (!$author) {
                return response()->json([
                    "success" => false, 
                    "message" => "Resource not fonud"
                ], 404);
            }
               
          
              return response()->json([
                "success" => true,
                "message" => "Get detail Resource",
                "data" => $author
            ], 200);
        
        }
        
}

