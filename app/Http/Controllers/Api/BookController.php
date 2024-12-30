<?php

namespace App\Http\Controllers\Api;
use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index(){
        $books = Book::all();
        return response()->json($books);
    }

    public function store(Request $request)
        {

            //1 . membuat validasi 
            $validator = Validator::make($request->all(),[
                "title" => "required|string|max:255",
                // foto nya bebas, nanti extensi nya yang mau ke sini
                "description" => "required|string|max:255",
                "price" =>  "required|Numeric",
                "stock" =>  "required|integer|min:0",
                "cover_photo" => "required|image|mimes:jpeg,png,gif,svg|max:2048",
                // harus nyamubung, gak pakai spasi
                "genre_id" => "required|exists:genres,id",
                "author_id" =>"required|exists:authors,id"
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
            // $image adalah variable, bebas tulis nya
            $image = $request->file('cover_photo');
            $image->store('books', 'public');         // suapa ya nanti file nya di simpan larave, di bagain folder storage, 



            // 4. insert data
            $book = Book::create([
                // name diambil dari name yang kita buat dari 
                "title" => $request->title,
                "description" => $request->description,
                "price" => $request->price,
                "stock" => $request->stock,
                "cover_photo" => $image->hashName(),
                // "photo" => $image,        // photo itu harus pakai hasing, biar gak ketimpa, kalau seperti ini gambar nya ada yang sama akan di timpa 
                "genre_id"=> $request->genre_id,
                "author_id" => $request->author_id
            ]);


            //5. return response

            // memberi pesan berhasil
            return response()->json([
                "success" => true,
                "message" => "Resource added Succesfully nya",
                "data" => $book
            ], 201);
        }
  

        
        public function show(string $id){
            $book = Book::find($id);
         
           
            // tugas : tambahkan error handling ketika id yang dicari tidak ditemukan
            // success = false
            // message = "Resource not fonud"
            // error 404
            if (!$book) {
                return response()->json([
                    "success" => false, 
                    "message" => "Resource not fonud"
                ], 404);
            }

            return response()->json([
                "success" => true,
                "message" => "Get detail Resource",
                "data" => $book
            ], 200);
        
        }

        //===========================================================================
        // 30 Desember 2024
        public function update(Request $request, string $id)
        {
            $book = Book::find($id);

            if(!$book){
                return response()->json([
                    "success" => false,
                    "message" => "Resource Not Found"
                ],404);
            }
            
            $validator = Validator::make($request->all(), [
                // nullable arti nya boleh gak isi
                "title" => "required|string|max:255",
                // foto nya bebas, nanti extensi nya yang mau ke sini
                "description" => "required|string|max:255",
                "price" =>  "required|Numeric",
                "stock" =>  "required|integer|min:0",
                "cover_photo" => "required|image|mimes:jpeg,png,gif,svg|max:2048",
                // harus nyamubung, gak pakai spasi
                "genre_id" => "required|exists:genres,id",
                "author_id" =>"required|exists:authors,id"
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
            "title"=>$request->title,

            // kalau ini berarti wajib dong, foto nya
            // "photo"=>$request->photo
            "description"=>$request->description,
            "price"=>$request->price,
            "stock"=>$request->stock,
     
            "genre_id"=>$request->genre_id,
            "author_id"=>$request->author_id,
        ];

             //... uplaod image, kalau tanpa kodingan upload image itu udah bisa
             if($request->hasFile('cover_photo')){
                $image= $request->file("cover_photo");
                $image->store('books', 'public');
    
                if($book->cover_photo){
    
                    //ini dari folder storage, file nya di hapus
                    Storage::disk("public")->delete('books/' . $book->cover_photo);
                };
    
                $data["cover_photo"] = $image->hashName();
            };


                // update data baru
                $book->update($data);

                return response()->json([
                    "success" => true,
                    "message" => "Get detail Resource",
                    "data" => $book
                ], 200);


        }

         //=====================================================================
    public function destroy(string $id)
    {
        $book = Book::find($id);
        
        if(!$book){
            return response()->json([
                "success"=> false,
                "message"=> "Resource Not Found!"
            ], 400);
    }

        
        if($book->cover_photo){
            Storage::disk('public')->delete('books/' . $book->cover_photo);
        }

        // delete data from db
        $book->delete();

        return response()->json([
            "success"=> true,
            "message"=> "Resource deleted Successfully"
        ], 200);
        
    }
        
}

