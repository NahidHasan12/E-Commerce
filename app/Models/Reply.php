<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'ticket_id',
        'message',
        'image',
        'reply_date',
        'user_id'
    ];
}
