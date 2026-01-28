<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user');

        // 🔍 SEARCH (dibungkus biar role tidak bocor)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('nis', 'like', '%' . $request->search . '%');
            });
        }

        // 🔃 SORT
        $sort = $request->query('sort', 'az');

        if ($sort === 'za') {
            $query->orderBy('name', 'desc');
        } else {
            $query->orderBy('name', 'asc');
        }

        // 📄 PAGINATION + bawa query (?search & ?sort)
        $users = $query->paginate(10)->withQueryString();

        return view('admin.daftarpengguna', compact('users', 'sort'));
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return back()->with('success', 'User berhasil dihapus');
    }
}

