<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;




class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
             return new OrderResource(true, "Get All Rosource", $orders);

   
            return response()->json([
                "status" => true,
                "message" => "GET ALL NOT Resource",
                "data" => $orders
            ] , 200);

    }


 

        public function store(Request $request)
        {

            //membuat validasi 
            $validator = Validator::make($request->all(),[
                 "order_number" => "required|string",
                "customer_id" => "required|exists:customer_id",
                "book_id" => "required|exists:customer_id",
                "total_amount"=>"required|Numeric",
                "status"=>"required|in:'pending','processing','shipped','completed','canceled'"
            ]);

            // melakukan cek data yang bermasalah
            if($validator ->fails()){
                return response()->json([
                    "success" => false,
                    "message" => $validator ->errors()
                ], 422);
            }
            //membuat data genre
            $order= Order::create([
                "order_number" => $request->order_number,
                "customer_id" => $request->customer_id,
                "book_id"=> $request->book_id,
                "total_amount"=> $request->total_amount,
                "status"=> $request->status,
            ]);

            // memberi pesan berhasil
            return response()-> json([
                "success" => true,
                "message" => "Resource added Succesfully nya",
                "data" => $order
            ], 201);
        }



        public function show(string $id){
            $order = Order::find($id);
         
      
            if (!$order) {
                return response()->json([
                    "success" => false, 
                    "message" => "Resource not fonud"
                ], 404);
            }
               
            return response()->json([
                "success" => true,
                "message" => "Get detail Resource",
                "data" => $order
            ], 200);
        }
            
  

     

        
        public function update(Request $request, string $id){
                //biasa nya taro  di paling atas sini
                $order = Order::find($id);
                
                if(!$order){
                    return response()->json(
                        [
                            "succes"=>false,
                            "message"=>"Resources Not Found"
                        ], 404);
                }

                // kayak function store, nanti ada validator, kita validasi

                // membuat validasi
                $validator = Validator::make($request->all(), [
                    "order_number" => "required|string",
                    "customer_id" => "required|exists:customer_id",
                    "book_id" => "required|exists:customer_id",
                    "total_amount"=>"required|Numeric",
                    "status"=>"required|in:'pending','processing','shipped','completed','canceled'"              
                ]);



                //untuk mengecek data yang bermasalah
                if($validator->fails()){
                    return response()->json([
                        "success"=> false,
                        "message"=> $validator->errors()
                    ],422);
           

              //terakhir kita copy bagian return nya
              $order->update([
                "order_number" => $request->order_number,
                "customer_id" => $request->customer_id,
                "book_id"=> $request->book_id,
                "total_amount"=> $request->total_amount,
                "status"=> $request->status,
              ]);

              return response()->json([
                "success"=> true,
                "message"=> "Resource update successfully",
                "data"=>$order
            ],200);
        }

    }
//==============================================================================================

    
   
        //Delete itu pakai function destroy
        public function destroy(string $id){
            $order = Order::find($id);

            if(!$order){
                return response()->json([
                    "success"=> false,
                    "message"=> "Resource Not Found"
                ],404);
            }


            $order->delete();

            return response()->json([
                "success" => true,
                "message" => "Resource deleted Succesfully"
            ],200);
        }
}