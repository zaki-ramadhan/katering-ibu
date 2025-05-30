<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    use HasFactory;
    
    protected $table = 'menu';
    protected $primaryKey = 'id';
    protected $fillable = ['foto_menu', 'nama_menu', 'deskripsi', 'harga'];

    public function getImageUrlAttribute()
    {
        if ($this->foto_menu) {
            // Menggunakan URL lengkap untuk akses gambar
            // return url('storage/' . $this->foto_menu);
            return asset('storage/' . $this->foto_menu);
        }
        return null;
    }

    protected $casts = [
        'harga' => 'float',
    ];

    // Override toArray untuk menyertakan URL gambar dalam response JSON
    public function toArray()
    {
        $array = parent::toArray();
        $array['image_url'] = $this->image_url;
        return $array;
    }
}