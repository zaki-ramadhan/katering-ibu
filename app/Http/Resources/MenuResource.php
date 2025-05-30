<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'foto' => $this->foto_menu ? asset('storage/' . $this->foto_menu) : null,
            'nama' => $this->nama_menu,
            'deskripsi' => $this->deskripsi,
            'harga' => $this->harga,
            'terjual' => $this->terjual,
        ];
    }
}
