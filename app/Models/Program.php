<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'name','destination','level','university','city',
        'duration','language','intake','tuition','description','status','application_fee','image',
    ];
}
