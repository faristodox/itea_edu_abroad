<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $fillable = ['name','label','required','active','sort_order'];

    protected $casts = [
        'required' => 'boolean',
        'active'   => 'boolean',
    ];

    public function scopeActive($q)    { return $q->where('active', true)->orderBy('sort_order'); }
    public function scopeRequired($q)  { return $q->where('required', true)->where('active', true); }
}
