<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warehouse extends Model
{
    use HasFactory;

    protected $fillable =[
        'warehouse_name',
        'warehouse_address',
        'warehouse_phone'
    ];
}
