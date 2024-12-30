<?php

namespace App\Http\Controllers\Api;
use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class AuthorController extends Controller
{
    public function index(){
        $authors = Author::all();
        // return response()->json($author);

        // karena kita pakai AuthorResoucre

        // AuthorResource, untuk kode yang 200 oke
        return new AuthorResource(true, "Get All Rosource", $authors);
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


        // ====================================================================


        // 30 Desember 2024

        public function update(Request $request, string $id){
          // cari data Author
          $author = Author::find($id);

          if(!$author){
            return response()->json([
                "success" => false,
                "message" => "Resource Not Found"
            ],404);
        }


        // kita boleh tanpa validator, tujuan nya kalau ada data yang error, yang error nya terjadi backend
        // jangan di database, nanti bahaya

        $validator = Validator::make($request->all(), [
            // nullable arti nya boleh gak isi
            "name" => "required|string|max:255",
            "photo" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "bio"=> "nullable|string"
        ]);
        


    if($validator->fails()){
        return response()->json([
            "success"=> false,
            "message"=> $validator->errors()
        ],422);
    }


        //sipakan data yang ingin di update
        $data =[
            // ini yang kita kirim 2 data aja
            "name"=>$request->name,

            // kalau ini berarti wajib dong, foto nya
            // "photo"=>$request->photo
            "bio"=>$request->bio
        ];


        //... uplaod image, kalau tanpa kodingan upload image itu udah bisa
        if($request->hasFile('photo')){
            $image= $request->file("photo");
            $image->store('authors', 'public');

            if($author->photo){

                //ini dari folder storage, file nya di hapus
                Storage::disk("public")->delete('authors/' . $author->photo);
            };

            $data["photo"] = $image->hashName();
        };


        // update data baru
        $author->update($data);

        return response()->json([
            "success" => true,
            "message" => "Get detail Resource",
            "data" => $author
        ], 200);
    
        
    }


    //=====================================================================
    public function destroy(string $id)
    {
        $author = Author::find($id);
        
        if(!$author):
            return response()->json([
                "success"=> false,
                "message"=> "Resource Not Found!"
            ], 400);
        endif;

        
        if($author->photo):
            Storage::disk('public')->delete('authors/' . $author->photo);
        endif;

        // delete data from db
        $author->delete();

        return response()->json([
            "success"=> true,
            "message"=> "Resource deleted Successfully"
        ]);
        
    }


}

