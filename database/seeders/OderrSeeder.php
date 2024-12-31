<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OderrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Order::create([                  // ini di import ke model
            "order_number"=> "1",
            "customer_id"=> 1,
            "book_id"=> 1,
            'total_amount'=> 50000,
            "status"=> "processing"
        ]);

        Order::create([                  // ini di import ke model
            "order_number"=> "2",
            "customer_id"=> 2,
            "book_id"=> 2,
            'total_amount'=> 70000,
            "status"=> "processing"
        ]);
               
    }
}
