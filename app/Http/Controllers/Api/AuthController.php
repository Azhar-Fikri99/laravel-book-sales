<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /*
    * Register a new user
    */

    public function register(Request $request){

        // 1. Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);


        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }


        // create User (sama kayak tambah data)
        $user = User::create([                  // ini harus kita tambahkan dari model
            "name" => $request->name,
            "email" => $request->email, 
            "password" => bcrypt($request->password)    // bcrypt itu juga dua arah
        ]);


        if($user){
            return response()->json([
                "success"=>true,
                "message"=> "User created successfuly",
                "data"=> $user
            ],201)
            ;
        }

        // Return response if process failed
        return response()->json([
            "success"=> false,
            "message"=> "User Creating failed"
        ], 409);                                    //409 itu ada di client, arti nya conflict

    }

    
    // kita bikin login and return token
    public function login(Request $request){
        //setup validator

        $validator = Validator::make($request->all(),[
            "email" => "required|email",
            "password"=>"required"       
            ]);

        // // check validator
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        

        //Get Credential from request
        // teman2 udah masukin email dan password, itu dibuatkan 1 baris kode, kode token, untuk akun yang pernah login
        $credential = $request->only("email", "password");

        // ini bisa langsung karena ada not nya,
        // kalau di pisah seperti ini
        // $token = auth()->guard('api')->attempt($credential)
        // if(!$token)

        if(!$token = auth()->guard('api')->attempt($credential)){
            return response()->json([
                'success'=> false,
                'message'=> "email atau password Anda Salah!"
            ],401);
        }

        return response()->json([
            "success"=> true,
            "message"=> "Login Successfully",
            "user"=> auth()->guard('api')->user(),
            'token'=> $token
            
        ], 200);          
    }


    //================================================================================
    /*
        logout user dan invalidate token
    */
    public function logout(Request $request){
        try{
            JWTAuth::invalidate(JWTAuth::getToken());

            //if logout succes
            return response()->json([
                    "success" =>true,
                    "message"=>"Logout Successfuly"       
            ],200);
        }catch(JWTException $e){
            //If logout failed
            return response()->json([
                'success'=>false,
                'message'=> 'logout failed'
            ], 500);
        }
    }
}
