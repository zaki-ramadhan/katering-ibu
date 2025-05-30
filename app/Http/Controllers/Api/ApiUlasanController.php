<?php

namespace App\Http\Controllers\Api;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use App\Http\Resources\UlasanResource;
use App\Http\Controllers\Controller;

class ApiUlasanController extends Controller
{
    public function index()
    {
        $ulasan = Ulasan::with('user')->latest()->get();

        if ($ulasan->isEmpty()) {
            return response()->json(['error' => 'Tidak ada data ulasan ditemukan'], 404);
        }

        return UlasanResource::collection($ulasan);
    }

    public function show($id)
    {
        $ulasan = Ulasan::with(['user', 'menu'])->find($id);

        if (!$ulasan) {
            return response()->json(['error' => 'Ulasan tidak ditemukan'], 404);
        }

        return new UlasanResource($ulasan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'pesan' => 'required|string'
        ]);

        $ulasan = Ulasan::create([
            'id_customer' => $request->user()->id,
            'email' => $request->email,
            'pesan' => $request->pesan
        ]);

        return new UlasanResource($ulasan);
    }

    public function update(Request $request, $id)
    {
        $ulasan = Ulasan::find($id);

        if (!$ulasan) {
            return response()->json(['error' => 'Ulasan tidak ditemukan'], 404);
        }

        if ($ulasan->user_id !==  $request->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'pesan' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        $ulasan->update([
            'pesan' => $request->pesan,
            'rating' => $request->rating,
        ]);

        return new UlasanResource($ulasan);
    }

    public function destroy(Request $request, $id)
    {
        $ulasan = Ulasan::find($id);

        if (!$ulasan) {
            return response()->json(['error' => 'Ulasan tidak ditemukan'], 404);
        }

        if ($ulasan->user_id !==  $request->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $ulasan->delete();

        return response()->json(['message' => 'Ulasan berhasil dihapus']);
    }
}
