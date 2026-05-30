<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationDocument extends Model
{
    protected $fillable = [
        'application_id','user_id','document_type','original_name','file_path','mime_type','file_size',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function typeLabel(): string
    {
        return match($this->document_type) {
            'passport'      => 'Passport',
            'transcript'    => 'Academic Transcript',
            'photo'         => 'Passport Photo',
            'certificate'   => 'Qualification Certificate',
            'language_cert' => 'Language Certificate',
            'medical'       => 'Medical Examination',
            'other'         => 'Other Document',
            default         => ucfirst($this->document_type),
        };
    }
}
