<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan'; // Penamaan tabel yang benar

    protected $fillable = [
        'user_id', 'payment_method', 'pickup_method', 'delivery_address', 'shipping_cost', 'total_amount', 'payment_proof', 'delivery_date', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(ItemPesanan::class);
    }
}
