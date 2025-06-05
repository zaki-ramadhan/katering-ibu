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

        return response()->json([
            'success' => true,
            'data' => $notifications,
        ], 200);
    }

    public function createNotification(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'order_id' => 'nullable|integer',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|string|max:50',
        ]);

        $notification = Notification::create([
            'user_id' => $request->user_id,
            'order_id' => $request->order_id,
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Notifikasi berhasil dibuat',
            'notification' => $notification,
        ], 201);
    }
}
