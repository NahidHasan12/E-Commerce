<?php

namespace App\Models;

use App\Models\category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'category_id',
        'subcategory_id',
        'childcategory_id',
        'brand_id',
        'pickup_point_id',
        'name',
        'slug',
        'code',
        'color',
        'size',
        'unit',
        'tags',
        'video',
        'purchase_price',
        'selling_price',
        'discount_price',
        'stock_quantity',
        'warehouse',
        'description',
        'status',
        'thumbnail',
        'images',
        'product_views',
        'trendy',
        'featured',
        'slider_show',
        'today_deal',
        'flash_deal_id',
        'cash_on_delivery',
        'admin_id',
        'date',
        'month'
    ];

    public function category(){
        return $this->belongsTo(category::class);
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
}
