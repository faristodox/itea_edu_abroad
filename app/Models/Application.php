<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id','program_name','destination','level','university','intake',
        'full_name','date_of_birth','nationality','phone','address',
        'current_education_level','current_institution','graduation_year','gpa','personal_statement',
        'status','result','admin_notes','submitted_at',
        'offer_letter_path','payment_status','payment_amount','stripe_session_id','stripe_payment_id','paid_at',
    ];

    protected $casts = [
        'date_of_birth'    => 'date',
        'submitted_at'     => 'datetime',
        'paid_at'          => 'datetime',
        'payment_amount'   => 'decimal:2',
    ];

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function requiresPayment(): bool
    {
        return $this->status === 'result' && $this->result === 'accepted' && $this->payment_status === 'unpaid';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(ApplicationDocument::class);
    }

    public function statusLabel(): string
    {
        return match($this->status) {
            'draft'      => 'Draft',
            'submitted'  => 'Submitted',
            'reviewing'  => 'Under Review',
            'result'     => $this->result ? ucfirst($this->result) : 'Result Ready',
            default      => ucfirst($this->status),
        };
    }

    public function statusColor(): string
    {
        return match($this->status) {
            'draft'     => '#6b7280',
            'submitted' => '#2563eb',
            'reviewing' => '#d97706',
            'result'    => $this->result === 'accepted' ? '#16a34a' : '#dc2626',
            default     => '#6b7280',
        };
    }
}
