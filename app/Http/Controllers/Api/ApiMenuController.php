<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class ApiMenuController extends Controller
{
    public function index()
    {
        try {
            $menus = Menu::all();

            return response()->json([
                'success' => true,
                'data' => $menus
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data menu: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $menu = Menu::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $menu
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Menu tidak ditemukan'
            ], 404);
        }
    }
}
