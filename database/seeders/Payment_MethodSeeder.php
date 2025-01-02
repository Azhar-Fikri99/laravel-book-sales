<?php

namespace Database\Seeders;

use App\Models\Payment_Method;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Payment_MethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Payment_Method::create([                  // ini di import ke model
                "name"=> "BCA",
                "account_number"=> 12345678901,
                "image"=> "BCA.jpg"
            ]);
    
            Payment_Method::create([                  // ini di import ke model
                "name"=> "BTN",
                "account_number"=> 9876543213,
                "image"=> "BTN.jpg"
            ]);
                   

            
            Payment_Method::create([                  // ini di import ke model
                "name"=> "BNI",
                "account_number"=> 444433323,
                "image"=> "BNI.jpg"
            ]);
        
    }
}
