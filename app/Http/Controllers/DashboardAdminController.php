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
        // === CARD STATISTIK ===
        $totalUsers = User::where('role', 'user')->count();
        $totalCategories = Category::count();
        $totalAspirations = Aspiration::count();

        // === LIST USER TERBARU ===
        $latestUsers = User::where('role', 'user')
            ->latest()
            ->take(4)
            ->get();

        // === CHART PENGADUAN (STATUS) ===
        $pengaduanChart = Aspiration::select(
                'status',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('status')
            ->orderBy('status')
            ->get();

        // Chart penambahan pengguna per bulan (TAHUN INI)
        $userChart = User::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', now()->year)
            ->where('role', 'user')
            ->groupBy('month')
            ->orderBy('month')
            ->get();


        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCategories',
            'totalAspirations',
            'latestUsers',
            'pengaduanChart',
            'userChart'
        ));
    }
}
