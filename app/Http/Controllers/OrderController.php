<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(Request $request)
    {
        $menus = collect([
            [
                'name' => 'Baso Ikan',
                'price' => 20000,
                'img' => asset('images/baso ikan.jpg'),
                'details' => 'Baso ikan segar dengan kuah kaldu istimewa.',
                'rating' => 4,
            ],
            // Tambahkan menu lainnya sesuai dengan array di atas...
        ]);

        $menuName = $request->query('menu');
        $menu = $menus->firstWhere('name', $menuName);

        if (!$menu) {
            abort(404, 'Menu not found');
        }

        return view('order-now', compact('menu'));
    }
}
