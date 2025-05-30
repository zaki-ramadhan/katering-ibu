<?php
namespace App\Http\Controllers\Api;

use App\Models\Notification; // Pastikan model Notification sudah dibuat
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiNotificationController extends Controller
{
    public function getNotifications(Request $request)
    {
        $user = $request->user(); // Ambil pengguna yang sedang login

        // Ambil data notifikasi berdasarkan user_id
        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan waktu dibuat
            ->get();

        if ($notifications->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada notifikasi ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Notifikasi berhasil diambil',
            'notifications' => $notifications,
        ], 200);
    }
}