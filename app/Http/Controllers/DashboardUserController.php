<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardUserController extends Controller
{
    public function index()
{
    $userId = Auth::id();

    // Statistik Status
    $menunggu = Aspiration::where('user_id', $userId)
        ->where('status', 'menunggu')
        ->count();

    $proses = Aspiration::where('user_id', $userId)
        ->where('status', 'diproses')
        ->count();

    $selesai = Aspiration::where('user_id', $userId)
        ->where('status', 'selesai')
        ->count();

    // 🔥 TAMBAHKAN INI
    $latest = Aspiration::where('user_id', $userId)
        ->latest()
        ->take(5)
        ->get();

    // Statistik Harian
    $harian = Aspiration::select(
            DB::raw('DATE(created_at) as tanggal'),
            DB::raw('COUNT(*) as total')
        )
        ->where('user_id', $userId)
        ->whereDate('created_at', '>=', now()->subDays(6))
        ->groupBy('tanggal')
        ->orderBy('tanggal')
        ->get();

    // Statistik Bulanan
    $bulanan = Aspiration::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )
        ->where('user_id', $userId)
        ->whereYear('created_at', now()->year)
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    return view('user.dashboard', compact(
        'menunggu',
        'proses',
        'selesai',
        'harian',
        'bulanan',
        'latest' // 🔥 jangan lupa kirim ke view
    ));
}
}
