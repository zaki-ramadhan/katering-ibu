<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\KeranjangItem;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiKeranjangController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();

            // Ambil keranjang aktif user dengan relationship menu
            $keranjang = Keranjang::where('user_id', $user->id)
                ->where('status', 'pending')
                ->with(['items.menu'])
                ->first();

            if (!$keranjang) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'keranjang' => null,
                        'items' => [],
                        'total_harga' => 0,
                        'total_items' => 0
                    ]
                ]);
            }

            // Debug: Log data yang akan dikirim
            Log::info('Keranjang data:', $keranjang->toArray());

            return response()->json([
                'success' => true,
                'data' => [
                    'keranjang' => $keranjang,
                    'items' => $keranjang->items,
                    'total_harga' => $keranjang->total_harga,
                    'total_items' => $keranjang->items->sum('jumlah')
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error in keranjang index: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data keranjang: ' . $e->getMessage()
            ], 500);
        }
    }

    public function addItem(Request $request)
    {
        try {
            $request->validate([
                'menu_id' => 'required|exists:menu,id', // Gunakan tabel 'menu'
                'jumlah' => 'required|integer|min:1'
            ]);

            $user = Auth::user();
            $menu = Menu::findOrFail($request->menu_id);

            Log::info('Adding menu to cart:', [
                'user_id' => $user->id,
                'menu_id' => $request->menu_id,
                'menu_data' => $menu->toArray(),
                'jumlah' => $request->jumlah
            ]);

            DB::beginTransaction();

            // Cari atau buat keranjang aktif
            $keranjang = Keranjang::firstOrCreate([
                'user_id' => $user->id,
                'status' => 'pending'
            ], [
                'total_harga' => 0
            ]);

            // Cari item yang sudah ada di keranjang
            $existingItem = KeranjangItem::where('keranjang_id', $keranjang->id)
                ->where('menu_id', $request->menu_id)
                ->first();

            if ($existingItem) {
                // Update jumlah jika item sudah ada
                $existingItem->jumlah += $request->jumlah;
                $existingItem->total_harga_item = $existingItem->jumlah * $menu->harga;
                $existingItem->save();
            } else {
                // Buat item baru
                KeranjangItem::create([
                    'keranjang_id' => $keranjang->id,
                    'menu_id' => $request->menu_id,
                    'jumlah' => $request->jumlah,
                    'harga' => $menu->harga,
                    'total_harga_item' => $request->jumlah * $menu->harga
                ]);
            }

            // Update total harga keranjang
            $this->updateTotalHarga($keranjang->id);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil ditambahkan ke keranjang'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error adding item to cart: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan item ke keranjang: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateItem(Request $request, $itemId)
    {
        try {
            $request->validate([
                'jumlah' => 'required|integer|min:1'
            ]);

            $user = Auth::user();

            $item = KeranjangItem::whereHas('keranjang', function ($query) use ($user) {
                $query->where('user_id', $user->id)->where('status', 'pending');
            })->findOrFail($itemId);

            DB::beginTransaction();

            $item->jumlah = $request->jumlah;
            $item->total_harga_item = $item->jumlah * $item->harga;
            $item->save();

            // Update total harga keranjang
            $this->updateTotalHarga($item->keranjang_id);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate item: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeItem($itemId)
    {
        try {
            $user = Auth::user();

            $item = KeranjangItem::whereHas('keranjang', function ($query) use ($user) {
                $query->where('user_id', $user->id)->where('status', 'pending');
            })->findOrFail($itemId);

            DB::beginTransaction();

            $keranjangId = $item->keranjang_id;
            $item->delete();

            // Update total harga keranjang
            $this->updateTotalHarga($keranjangId);

            // Hapus keranjang jika tidak ada item
            $remainingItems = KeranjangItem::where('keranjang_id', $keranjangId)->count();
            if ($remainingItems == 0) {
                Keranjang::find($keranjangId)->delete();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus dari keranjang'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus item: ' . $e->getMessage()
            ], 500);
        }
    }

    public function clearCart()
    {
        try {
            $user = Auth::user();

            $keranjang = Keranjang::where('user_id', $user->id)
                ->where('status', 'pending')
                ->first();

            if ($keranjang) {
                DB::beginTransaction();

                // Hapus semua items
                KeranjangItem::where('keranjang_id', $keranjang->id)->delete();

                // Hapus keranjang
                $keranjang->delete();

                DB::commit();
            }

            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil dikosongkan'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengosongkan keranjang: ' . $e->getMessage()
            ], 500);
        }
    }

    private function updateTotalHarga($keranjangId)
    {
        $totalHarga = KeranjangItem::where('keranjang_id', $keranjangId)
            ->sum('total_harga_item');

        Keranjang::where('id', $keranjangId)
            ->update(['total_harga' => $totalHarga]);
    }
}
