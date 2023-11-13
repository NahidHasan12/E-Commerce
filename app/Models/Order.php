<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'c_name',
        'c_phone',
        'c_country',
        'c_city',
        'c_address',
        'c_email',
        'c_zipCode',
        'date',
        'subtotal',
        'total',
        'coupon_code',
        'coupon_discount',
        'main_balance',
        'payment_type',
        'tax',
        'shipping_charge',
        'status'
    ];
}
