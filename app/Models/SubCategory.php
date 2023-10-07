<?php

namespace App\Models;

use App\Models\category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable=[
        'subcategory_name',
        'subcategory_slug',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(category::class);
    }
}
