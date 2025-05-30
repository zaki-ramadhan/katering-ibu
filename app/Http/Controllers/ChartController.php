<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function barChart()
    {
        $data = [
            'labels' => ['January', 'February', 'March', 'April', 'May'],
            'data' => [65, 59, 80, 81, 56],
        ];
        return view('admin.data-penjualan', compact('data'));
    }
}