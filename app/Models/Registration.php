<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';

    protected $fillable = [
        'registration_id',
        'ticket_number',
        'name',
        'email',
        'phone',
        'tickets_count',
        'notes',
        'payment_screenshot',
        'payment_reference',
        'status',
    ];

    protected $casts = [
        'tickets_count' => 'integer',
        'status' => 'string',
    ];

    // Optional: accessor for total amount
    public function getTotalAmountAttribute()
    {
        return $this->tickets_count * 200; // $200 per ticket
    }

    // Scope for confirmed registrations
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    // Scope for pending
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}