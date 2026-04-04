<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Aspiration;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // === CARD ===
        $totalUsers = User::where('role', 'user')->count();
        $totalCategories = Category::count();
        $totalAspirations = Aspiration::count();

        // === USER TERBARU ===
        $latestUsers = User::where('role', 'user')
            ->latest()
            ->take(4)
            ->get();

        // === 🔥 TAMBAHAN: LAPORAN TERBARU ===
        $latestAspirations = Aspiration::with('user') // penting buat ambil nama user
            ->latest()
            ->take(5)
            ->get();

        // === USER PER BULAN ===
        $userChart = User::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', now()->year)
            ->where('role', 'user')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // === PENGADUAN PER BULAN ===
        $pengaduanPerBulan = Aspiration::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCategories',
            'totalAspirations',
            'latestUsers',
            'latestAspirations', // 🔥 kirim ke view
            'userChart',
            'pengaduanPerBulan'
        ));
    }
}
