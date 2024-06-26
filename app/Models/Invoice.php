<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'metodePembayaran',
        'booking_id',
        'statusLengkap',
        'user_id',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
