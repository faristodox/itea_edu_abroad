<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'whatsapp',
        'destination',
        'level',
        'intake',
        'message',
        'status',
    ];
}
