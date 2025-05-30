<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UlasanResource extends JsonResource
{
    public function toArray($request)
    {
        Carbon::setLocale('id'); // Set locale ke Bahasa Indonesia

        return [
            'id' => $this->id,
            'user' => [
                'id' => $this->user->id,
                'nama' => $this->user->name,
                'foto_profil' => $this->user->foto_profile
                    ? asset('storage/' . $this->user->foto_profile)
                    : null,
            ],
            'pesan' => $this->pesan,
            'waktu' => $this->created_at->diffForHumans(), // format waktu yang lebih user friendly
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
