<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar; // Import model Pendaftar

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hitung jumlah total pendaftar, diterima, dan ditolak
        $totalPendaftar = Pendaftar::count();
        $totalDiterima = Pendaftar::where('status', 'diterima')->count();
        $totalDitolak = Pendaftar::where('status', 'ditolak')->count();

        return view('dashboard.index', compact('totalPendaftar', 'totalDiterima', 'totalDitolak'));
    }
}
