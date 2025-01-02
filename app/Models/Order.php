<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    // kalau ini yang boleh di tambah data nya
      protected $fillable = [
        "order_number", "customer_id", "book_id","total_amount","status"
    ];

    //kalau mau singkat, bisa pakai $guards
    // kalau ini kita gak mau di tambahin data nya, karena udah ada auto_increment
    // protected $guards = [
    //   'id'
    // ];
}
