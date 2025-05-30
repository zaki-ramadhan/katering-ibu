<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Resources\MenuResource;
use App\Http\Controllers\Controller;

class ApiMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();

        if ($menus->isEmpty()) {
            return response()->json(['error' => 'Tidak ada data menu ditemukan'], 404);
        }

        return MenuResource::collection($menus);
    }

    public function show($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json(['error' => 'Menu tidak ditemukan'], 404);
        }

        return new MenuResource($menu);
    }
}