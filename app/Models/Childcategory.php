<?php

namespace App\Models;

use App\Models\category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Childcategory extends Model
{
    use HasFactory;
    protected $fillable=[
        'childcategory_name',
        'childcategory_slug',
        'category_id',
        'subcategory_id'
    ];

    public function category(){
        return $this->belongsTo(category::class);
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }
}
