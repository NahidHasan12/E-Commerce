<?php

namespace App\Models;

use App\Models\SubCategory;
use App\Models\Childcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    use HasFactory;
    protected $fillable = ['icon','category_name','category_slug','home_page'];

    public function subcategory(){
        return $this->hasMany(SubCategory::class);
    }
    // public function childcategory(){
    //     return $this->hasMany(Childcategory::class);
    // }
}
