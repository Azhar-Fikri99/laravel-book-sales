<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentsController extends Controller
{


    // public index
    public function index(){
        $payments = Payments::all();
        return new PaymentResource(true, "Get All Rosource", $payments);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            // di sini sebenar nya kita cukup 2 aja

            // books, id dari table book
            // 2 item ini akan ada di postman, body nya
                    // "order_id", "payment_method_id", "amount", "status", "staff_confirmed_by", "staff_confirmed_at"
            "order_id" => "required|string",
            "payment_method_id" => "required|integer",
            "amount" => "required|decimal",
            "status" => "required|decimal",
        ]);

    }
}
