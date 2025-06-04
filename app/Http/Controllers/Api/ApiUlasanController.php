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

        return response()->json([
            'success' => true,
            'data' => UlasanResource::collection($ulasan),
            'message' => 'Data ulasan berhasil diambil'
        ], 200);
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
            'order_id' => 'required|integer',
            'feedback' => 'required|string|max:1000',
        ]);

        $ulasan = Ulasan::create([
            'id_customer' => $request->user()->id,
            'id_pesanan' => $request->order_id,
            'pesan' => $request->feedback
        ]);

        return response()->json([
            'success' => true,
            'data' => new UlasanResource($ulasan),
            'message' => 'Feedback berhasil dikirim'
        ], 201);
    }

    public function checkUserReviewForOrder(Request $request, $orderId)
    {
        try {
            $userId = $request->user()->id;

            $ulasan = Ulasan::where('id_customer', $userId)
                ->where('id_pesanan', $orderId)
                ->first();

            return response()->json([
                'success' => true,
                'has_reviewed' => $ulasan !== null,
                'review_data' => $ulasan ? new UlasanResource($ulasan) : null,
                'message' => $ulasan ? 'User sudah memberikan ulasan' : 'User belum memberikan ulasan'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengecek ulasan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $ulasan = Ulasan::find($id);

        if (!$ulasan) {
            return response()->json(['error' => 'Ulasan tidak ditemukan'], 404);
        }

        if ($ulasan->id_customer !== $request->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        $ulasan->update([
            'pesan' => $request->feedback,
        ]);

        return response()->json([
            'success' => true,
            'data' => new UlasanResource($ulasan),
            'message' => 'Ulasan berhasil diupdate'
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $ulasan = Ulasan::find($id);

        if (!$ulasan) {
            return response()->json(['error' => 'Ulasan tidak ditemukan'], 404);
        }

        if ($ulasan->id_customer !== $request->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $ulasan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil dihapus'
        ], 200);
    }
}
