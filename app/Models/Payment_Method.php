<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment_Method extends Model
{
    //
  
    protected $fillable = [
      "name", "account_number", "image"
    ];
}