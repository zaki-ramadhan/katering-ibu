<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Keranjang;
use App\Models\KeranjangItem;
use App\Models\ItemPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
                'status' => 'Pending',
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
        try {
            $user = $request->user();

            // ✅ PERBAIKAN: Prioritaskan updated_at dan konsisten URL generation
            $orders = Pesanan::with(['items.menu'])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc') 
                ->get()
                ->map(function ($order) {
                    return [
                        'id' => $order->id,
                        'total_amount' => $order->total_amount,
                        'status' => $order->status,
                        'delivery_date' => $order->delivery_date,
                        'created_at' => $order->created_at->toISOString(),
                        'updated_at' => $order->updated_at->toISOString(), // ✅ Tambahkan updated_at
                        'pickup_method' => $order->pickup_method,
                        'delivery_address' => $order->delivery_address,
                        'payment_method' => $order->payment_method,
                        'status_payment_proof' => $order->status_payment_proof,

                        // ✅ PERBAIKAN: Konsisten generate full URL
                        'payment_proof' => $order->payment_proof
                            ? asset('storage/payment_proofs/' . $order->payment_proof)
                            : null,

                        'shipping_cost' => $order->shipping_cost ?? 0,
                        'items' => $order->items->map(function ($item) {
                            return [
                                'id' => $item->id,
                                'quantity' => $item->quantity,
                                'price' => $item->price,
                                'menu' => [
                                    'id' => $item->menu->id,
                                    'nama_menu' => $item->menu->nama_menu,
                                    'harga' => $item->menu->harga,
                                    // ✅ PERBAIKAN: Konsisten generate URL untuk menu foto
                                    'foto' => $item->menu->foto_menu
                                        ? asset('storage/' . $item->menu->foto_menu)
                                        : null,
                                ]
                            ];
                        })
                    ];
                });

            return response()->json([
                'status' => 'success',
                'data' => $orders
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil riwayat pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteOrder(Request $request, $id)
    {
        try {
            $user = $request->user();

            $order = Pesanan::where('id', $id)
                ->where('user_id', $user->id)
                ->first();

            if (!$order) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pesanan tidak ditemukan'
                ], 404);
            }

            if (!in_array($order->status, ['Completed', 'Rejected', 'Pending'])) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pesanan dengan status ini tidak dapat dihapus'
                ], 400);
            }

            DB::beginTransaction();

            $order->items()->delete();
            $order->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Pesanan berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function uploadPaymentProof(Request $request, $id)
    {
        try {
            Log::info('Upload payment proof started', [
                'order_id' => $id,
                'user_id' => Auth::id(),
                'has_file' => $request->hasFile('payment_proof')
            ]);

            $request->validate([
                'payment_proof' => 'required|image|mimes:jpeg,jpg,png|max:5120', // Max 5MB
            ]);

            $pesanan = Pesanan::where('id', $id)
                ->where('user_id', Auth::id())
                ->first();

            if (!$pesanan) {
                Log::warning('Order not found', ['order_id' => $id, 'user_id' => Auth::id()]);
                return response()->json([
                    'success' => false,
                    'message' => 'Pesanan tidak ditemukan atau bukan milik Anda'
                ], 404);
            }

            Log::info('Order found', [
                'order_id' => $pesanan->id,
                'current_payment_proof' => $pesanan->payment_proof,
                'current_status' => $pesanan->status_payment_proof
            ]);

            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');

                Log::info('File details', [
                    'original_name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                ]);

                // Hapus file lama jika ada
                if ($pesanan->payment_proof && Storage::disk('public')->exists('payment_proofs/' . $pesanan->payment_proof)) {
                    Storage::disk('public')->delete('payment_proofs/' . $pesanan->payment_proof);
                    Log::info('Old payment proof deleted', ['old_file' => $pesanan->payment_proof]);
                }

                // Upload file baru
                $fileName = time() . '_' . $pesanan->id . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('payment_proofs', $fileName, 'public');

                Log::info('File uploaded', [
                    'file_name' => $fileName,
                    'file_path' => $filePath
                ]);

                // Update database
                $pesanan->update([
                    'payment_proof' => $fileName,
                    'status_payment_proof' => 'Pending',
                ]);

                Log::info('Database updated', [
                    'order_id' => $pesanan->id,
                    'new_payment_proof' => $fileName,
                    'new_status' => 'Pending'
                ]);

                // Refresh model untuk memastikan data ter-update
                $pesanan->refresh();

                $paymentProofUrl = asset('storage/payment_proofs/' . $fileName);

                Log::info('Payment proof URL generated', ['url' => $paymentProofUrl]);

                return response()->json([
                    'success' => true,
                    'message' => "Bukti pembayaran pesanan #$pesanan->id berhasil diunggah dan sedang dalam proses verifikasi",
                    'data' => [
                        'payment_proof' => $fileName,
                        'payment_proof_url' => $paymentProofUrl,
                        'status_payment_proof' => $pesanan->status_payment_proof,
                        'order_id' => $pesanan->id
                    ]
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'File bukti pembayaran tidak ditemukan'
            ], 400);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Upload payment proof error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'order_id' => $id ?? null,
                'user_id' => Auth::id() ?? null
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getOrderDetail($id)
    {
        try {
            $pesanan = Pesanan::with(['items.menu', 'user'])
                ->where('id', $id)
                ->where('user_id', Auth::id())
                ->first();

            if (!$pesanan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pesanan tidak ditemukan'
                ], 404);
            }

            $orderData = [
                'id' => $pesanan->id,
                'status' => $pesanan->status,
                'total_amount' => $pesanan->total_amount,
                'shipping_cost' => $pesanan->shipping_cost,
                'payment_method' => $pesanan->payment_method,
                'pickup_method' => $pesanan->pickup_method,
                'delivery_address' => $pesanan->delivery_address,
                'delivery_date' => $pesanan->delivery_date,
                'payment_proof' => $pesanan->payment_proof
                    ? asset('storage/payment_proofs/' . $pesanan->payment_proof)
                    : null,
                'status_payment_proof' => $pesanan->status_payment_proof,
                'created_at' => $pesanan->created_at->toISOString(),
                'items' => $pesanan->items->map(function ($item) {
                    return [
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'menu' => [
                            'id' => $item->menu->id,
                            'nama_menu' => $item->menu->nama_menu,
                            'foto' => $item->menu->foto
                                ? asset('storage/menu_images/' . $item->menu->foto)
                                : null,
                        ]
                    ];
                })
            ];

            return response()->json([
                'success' => true,
                'data' => $orderData
            ], 200);
        } catch (\Exception $e) {
            Log::error('Get order detail error', [
                'error' => $e->getMessage(),
                'order_id' => $id
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server'
            ], 500);
        }
    }
}
