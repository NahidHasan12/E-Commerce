<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_Getway extends Model
{
    use HasFactory;
    protected $fillable=[
        'gateway_name',
        'store_id',
        'signature_key',
        'status'
    ];
}
