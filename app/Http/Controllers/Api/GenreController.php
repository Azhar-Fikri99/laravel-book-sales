<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;
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
                "message" => "GET ALL NOT Resource",
                "data" => $genres
            ] , 200);
        }
        // return response()->json([
        //     "status" => true,
        //     "message" => "GET ALL Resource nyaa",
        //     "data" => $genres
        // ] , 200);
        return new GenreResource(true, "Get All Rosource", $genres);
        
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

        

        // tanggal 30 Desember 2024
        // ini ada 2 parameter, kenapa butuh request ? karena kita mau kirim data yang baru
        // id untuk men-seleksi data nya
        public function update(Request $request, string $id){
                //biasa nya taro  di paling atas sini
                $genre = Genre::find($id);
                
                if(!$genre){
                    return response()->json(
                        [
                            "succes"=>false,
                            "message"=>"Resources Not Found"
                        ], 404);
                }

                // kayak function store, nanti ada validator, kita validasi

                // membuat validasi
                $validator = Validator::make($request->all(), [
                        "name" => "required|string",
                        "description"=> "required|string"                  
                ]);



                //untuk mengecek data yang bermasalah
                if($validator->fails()){
                    return response()->json([
                        "success"=> false,
                        "message"=> $validator->errors()
                    ],422);
                }

                // apa yang mau di update ? kita ambil data nya yang validator
              $genre->update($request->only("name","description" ));


              //terakhir kita copy bagian return nya
              return response()->json([
                "success"=> true,
                "message"=> "Resource update successfully",
                "data"=>$genre
            ],200);
        }


//==============================================================================================

        //Delete itu pakai function destroy
        public function destroy(string $id){
            $genre = Genre::find($id);

            if(!$genre){
                return response()->json([
                    "success"=> false,
                    "message"=> "Resource Not Found"
                ],404);
            }


            $genre->delete();

            return response()->json([
                "success" => true,
                "message" => "Resource deleted Succesfully"
            ],200);
        }
}





