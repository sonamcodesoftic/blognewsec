<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'name', 'detail'
        'id ','user_id ','client_id','name','scopes'
      
    ];
}
