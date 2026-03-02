<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class IndexUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user');

        // SEARCH
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('nis', 'like', '%' . $request->search . '%');
            });
        }

        $sort = $request->query('sort', 'az');

        if ($sort === 'za') {
            $query->orderBy('name', 'desc');
        } else {
            $query->orderBy('name', 'asc');
        }

        // 📄 PAGINATION
        $users = $query->paginate(10)->withQueryString();

        return view('admin.daftarpengguna', compact('users', 'sort'));
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return back()->with('success', 'User berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'daftar_pengguna.xlsx');
    }
}

