<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';
    protected $primaryKey = 'id';

    protected $fillable = ['id_customer', 'pesan'];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_customer'); // Pastikan 'user_id' adalah foreign key yang tepat di tabel ulasan
    }
}
