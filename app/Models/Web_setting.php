<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Web_setting extends Model
{
    use HasFactory;
    protected $fillable =[
        'currency',
        'phone_one',
        'phone_two',
        'main_email',
        'support_mail',
        'logo',
        'favicon',
        'address',
        'facebook',
        'twitter',
        'linkedin',
        'youtube'
    ];
}
