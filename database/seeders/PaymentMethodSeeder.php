<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        PaymentMethod::create([                  // ini di import ke model
                "name"=> "BCA",
                "account_number"=> 123456,
                "image"=> "BCA.jpg"
            ]);
    
            PaymentMethod::create([                  // ini di import ke model
                "name"=> "BTN",
                "account_number"=> 98765,
                "image"=> "BTN.jpg"
            ]);
                   

            
            PaymentMethod::create([                  // ini di import ke model
                "name"=> "BNI",
                "account_number"=> 4444,
                "image"=> "BNI.jpg"
            ]);
        
    }
}
