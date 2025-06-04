<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';
    protected $primaryKey = 'id';

    protected $fillable = ['id_customer', 'email', 'pesan', 'id_pesanan'];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_customer'); // Pastikan 'user_id' adalah foreign key yang tepat di tabel ulasan
    }

    public function order()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}
