<?php

namespace App\Http\Controllers\Api;

use App\Models\Pesanan;
use App\Models\Keranjang;
use App\Models\KeranjangItem;
use App\Models\ItemPesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApiOrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $request->validate([
            'pickup_method' => 'required|in:pickup,delivery',
            'payment_method' => 'required|in:cash,cashless',
            'delivery_address' => 'required_if:pickup_method,delivery',
            'transfer_method' => 'required_if:payment_method,cashless|in:bri,dana',
        ]);

        DB::beginTransaction();
        try {
            $user = Auth::user();

            $keranjang = Keranjang::where('user_id', $user->id)->first();
            if (!$keranjang) {
                return response()->json([
                    'success' => false,
                    'message' => 'Keranjang kosong'
                ], 400);
            }

            $cartItems = KeranjangItem::where('keranjang_id', $keranjang->id)->get();
            if ($cartItems->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Keranjang kosong'
                ], 400);
            }

            $subtotal = $cartItems->sum(function ($item) {
                return $item->harga * $item->jumlah;
            });

            $shippingCost = $request->pickup_method === 'delivery' ? 10000 : 0;
            $total = $subtotal + $shippingCost;

            $order = Pesanan::create([
                'user_id' => $user->id,
                'pickup_method' => $request->pickup_method,
                'payment_method' => $request->payment_method,
                'delivery_address' => $request->delivery_address,
                'shipping_cost' => $shippingCost,
                'total_amount' => $total,
                'status' => 'pending',
                'delivery_date' => now()->addDays(1)->format('Y-m-d'),
                'status_payment_proof' => $request->payment_method === 'cash' ? 'Accepted' : 'Pending',
            ]);

            foreach ($cartItems as $cartItem) {
                ItemPesanan::create([
                    'pesanan_id' => $order->id,
                    'menu_id' => $cartItem->menu_id,
                    'quantity' => $cartItem->jumlah,
                    'price' => $cartItem->harga,
                ]);
            }

            $cartItems->each->delete();
            $keranjang->delete();

            DB::commit();

            $response = [
                'success' => true,
                'message' => 'Pesanan berhasil dibuat',
                'data' => [
                    'order_id' => $order->id,
                    'total_amount' => $total,
                    'payment_method' => $request->payment_method,
                ]
            ];

            if ($request->payment_method === 'cashless') {
                $response['data']['transfer_info'] = [
                    'method' => $request->transfer_method,
                    'account_info' => $request->transfer_method === 'bri'
                        ? 'BRI: 4194 0103 9789 537 a.n. Fiqry Omar Atala'
                        : 'DANA: +62 812-3456-7890 a.n. Sausan Ronna Ullaya'
                ];
            }

            return response()->json($response);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

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
