<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;

    Protected $fillable =['user_id','product_id','date'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
