<?php

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    use HasFactory;
    protected $fillable = ['category_name','category_slug'];

    public function subcategory(){
        return $this->hasMany(SubCategory::class);
    }
}
