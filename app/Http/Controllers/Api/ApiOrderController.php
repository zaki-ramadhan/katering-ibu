<?php
namespace App\Http\Controllers\Api;

use App\Models\Pesanan; // Pastikan model Order sudah diimport
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiOrderController extends Controller
{
    public function getOrderHistory(Request $request)
    {
        $user = $request->user();

        $orders = Pesanan::with('items.menu')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada riwayat pesanan ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Riwayat pesanan berhasil diambil',
            'orders' => $orders,
        ], 200);
    }
}