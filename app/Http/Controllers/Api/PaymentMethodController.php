<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Payment_MethodResource;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    //
    public function index(){
        $payment_methods = PaymentMethod::all();
             return new Payment_MethodResource(true, "Get All Rosource", $payment_methods);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            // di sini sebenar nya kita cukup 2 aja

            // books, id dari table book
            // 2 item ini akan ada di postman, body nya
            "name" => "required|string",
            "account_number" => "required|integer",
            "image" => "required|image|mimes:jpeg,png,gif,svg|max:2048",

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
            // // $image adalah variable, bebas tulis nya
            // $image = $request->file('image');
            // $image->store('payment_methods', 'public');         // suapa ya nanti file nya di simpan larave, di bagain folder storage,

            $image = $request->file('image');
            $image->store('payment_methods', 'public');         // siapa  nanti file nya di simpan laravel, di bagain folder storage,







            //4. insert data
            //Order nya dari model, pakai O nya huruf besar
            $payment_method= PaymentMethod::create([
                // ini masih kita kosongin
                //variable $orderNumber sudah ada, kita tinggal copas aja di sini
                'name' => $request->name,

                //nanti isi dari customer_id adalah $user dari yang atas nya yang auth
                "account_number" => $request->account_number,
                "image" =>$image->hashName()
            ]);



            return new Payment_MethodResource(true, "Order Created Successfully", $payment_method);
    }




    public function show(string $id){
        $payment_method = PaymentMethod::find($id);


        // tugas : tambahkan error handling ketika id yang dicari tidak ditemukan
        // success = false
        // message = "Resource not fonud"
        // error 404
        if (!$payment_method) {
            return response()->json([
                "success" => false,
                "message" => "Resource not fonud"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Get detail Resource",
            "data" => $payment_method
        ], 200);

    }


    //===================================================================
    //Update
    public function update(Request $request, string $id)
    {
        $payment_method = PaymentMethod::find($id);

        if(!$payment_method){
            return response()->json([
                "success" => false,
                "message" => "Resource Not Found"
            ],404);
        }

        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "account_number" => 'required|integer',
            "image" => "nullable|image|mimes:jpeg,png,gif,svg|max:2048",
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
        "account_number"=>$request->account_number,
    ];


        //... uplaod image, kalau tanpa kodingan upload image itu udah bisa
        if($request->hasFile('image')){
            $image_name= $request->file("image");
            // ini nanti di buatkan otomatis nama nya
            // payment_methods  dibuatkan
            $image_name->store('payment_methods', 'public');

            if($payment_method->image){

                //ini dari folder storage, file nya di hapus
                Storage::disk("public")->delete('payment_methods/' . $payment_method->image);
            };

            $data["image"] = $image_name->hashName();
        };

            // update data baru
            $payment_method->update($data);

            return response()->json([
                "success" => true,
                "message" => "Get detail Resource",
                "data" => $payment_method
            ], 200);


    }


    // destroy===================================================
    public function destroy(string $id)
    {
        $payment_method = PaymentMethod::find($id);

        if(!$payment_method){
            return response()->json([
                "success"=> false,
                "message"=> "Resource Not Found!"
            ], 400);
    }




        // delete data from db
        $payment_method->delete();

        return response()->json([
            "success"=> true,
            "message"=> "Resource deleted Successfully"
        ], 200);

    }

}
