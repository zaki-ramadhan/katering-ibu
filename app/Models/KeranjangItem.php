<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangItem extends Model
{
    use HasFactory;

    protected $table = 'keranjang_items';
    protected $fillable = ['keranjang_id', 'menu_id', 'jumlah', 'harga', 'total_harga_item'];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'keranjang_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
