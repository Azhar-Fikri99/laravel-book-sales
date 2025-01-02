<?php

// ini kalau kita masukin ke folder api
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;




class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
             return new OrderResource(true, "Get All Rosource", $orders);

   
            // return response()->json([
            //     "status" => true,
            //     "message" => "GET ALL NOT Resource",
            //     "data" => $orders
            // ] , 200);

    }


 

        public function store(Request $request)
        {

            //1. membuat validasi (validator)
            //2. Chek validator
            //3. insert data
            //4. return response 

            //validator kita ambil yang support:facades
            
              //1. membuat validasi (validator)
              
            $validator = Validator::make($request->all(),[
                // di sini sebenar nya kita cukup 2 aja
                
                // books, id dari table book
                // 2 item ini akan ada di postman, body nya
                "book_id" => "required|exists:books,id",

                "quantity" => 'required|integer|min:1'
                // "total_amount"=>"required|Numeric",
                // "status"=>"required|in:'pending','processing','shipped','completed','canceled'"
            ]);

              //2. Chek validator
            // melakukan cek data yang bermasalah
            if($validator ->fails()){
                return response()->json([
                    "success" => false,
                    "message" => $validator ->errors()
                ], 422);
            }

            // Buat-nomor order unik
            $orderNumber = "ORD-". strtoupper(uniqid());



            // ambil data user yang sedang login
            //biar aman, kita ambil nya jangan pakai request
            // kita bisa pakai auth('')->user()
            // $user = $request->user()->id;
            $user = auth('api')->user();
            //user nya dari middleware

            
            //cek login user
            if(!$user){
                return response()->json([
                    'status' => false,
                    'message' => "Unathorize"
                ], 401);
            }

            //ambil 1 data buku
            // Book nya jangan lupa di import yaa
            // kenapa kita ambil 1 buku saja, karena kita mau mengambil harga buku nya
            $book = Book::find($request->book_id);

            // $book ambil data stock di table book nya sendiri
            //quantity nya kita ambil dari request
            if($book->stock < $request->quantity){
                return response()->json([
                    "status" => false,
                    "message" => "stok barang tidak cukup"
                ],400);
            }

            // hitung total harga
            $totalAmount = $book->price * $request->quantity;

            // update kurang stok buku
            // ini kita pakai operator assigment, otomatis mengurangi
            $book->stock -= $request->quantity;
            $book->save();

             //3. insert data
            //Order nya dari model, pakai O nya huruf besar
            $order= Order::create([
                // ini masih kita kosongin 
                //variable $orderNumber sudah ada, kita tinggal copas aja di sini
                'order_number' => $orderNumber,

                //nanti isi dari customer_id adalah $user dari yang atas nya yang auth
                "customer_id" =>  $user->id,
                "book_id"=> $request->book_id,

                //kita harus tau dulu, buku yang maa
                "total_amount"=> $totalAmount,
                "status"=> 'pending'
            ]);

            
            //4. return response
            // memberi pesan berhasil
            // return response()-> json([
            //     "success" => true,
            //     "message" => "Resource added Succesfully nya",
            //     "data" => $order
            // ], 201);

            return new OrderResource(true, "Order Created Successfully", $order);
        }









        

//         public function show(string $id){
//             $order = Order::find($id);
         
      
//             if (!$order) {
//                 return response()->json([
//                     "success" => false, 
//                     "message" => "Resource not fonud"
//                 ], 404);
//             }
               
//             return response()->json([
//                 "success" => true,
//                 "message" => "Get detail Resource",
//                 "data" => $order
//             ], 200);
//         }
            
  

     

        
//         public function update(Request $request, string $id){
//                 //biasa nya taro  di paling atas sini
//                 $order = Order::find($id);
                
//                 if(!$order){
//                     return response()->json(
//                         [
//                             "succes"=>false,
//                             "message"=>"Resources Not Found"
//                         ], 404);
//                 }

//                 // kayak function store, nanti ada validator, kita validasi

//                 // membuat validasi
//                 $validator = Validator::make($request->all(), [
//                     "order_number" => "required|string",
//                     "customer_id" => "required|exists:customer_id",
//                     "book_id" => "required|exists:customer_id",
//                     "total_amount"=>"required|Numeric",
//                     "status"=>"required|in:'pending','processing','shipped','completed','canceled'"              
//                 ]);



//                 //untuk mengecek data yang bermasalah
//                 if($validator->fails()){
//                     return response()->json([
//                         "success"=> false,
//                         "message"=> $validator->errors()
//                     ],422);
           

//               //terakhir kita copy bagian return nya
//               $order->update([
//                 "order_number" => $request->order_number,
//                 "customer_id" => $request->customer_id,
//                 "book_id"=> $request->book_id,
//                 "total_amount"=> $request->total_amount,
//                 "status"=> $request->status,
//               ]);

//               return response()->json([
//                 "success"=> true,
//                 "message"=> "Resource update successfully",
//                 "data"=>$order
//             ],200);
//         }

//     }
// //==============================================================================================

    
   
//         //Delete itu pakai function destroy
//         public function destroy(string $id){
//             $order = Order::find($id);

//             if(!$order){
//                 return response()->json([
//                     "success"=> false,
//                     "message"=> "Resource Not Found"
//                 ],404);
//             }


//             $order->delete();

//             return response()->json([
//                 "success" => true,
//                 "message" => "Resource deleted Succesfully"
//             ],200);
//         }
}