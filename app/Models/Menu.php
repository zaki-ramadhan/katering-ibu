<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $fillable = [
        'foto_menu',
        'nama_menu',
        'deskripsi',
        'harga',
        'terjual',
        'kategori',
        'status'
    ];

    protected $casts = [
        'harga' => 'float',
        'terjual' => 'integer',
    ];

    // Accessor untuk foto
    public function getFotoAttribute()
    {
        if ($this->foto_menu) {
            return asset('storage/' . $this->foto_menu);
        }
        return '';
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['foto'] = $this->foto; // Tambahkan field foto dengan full URL
        return $array;
    }
}
