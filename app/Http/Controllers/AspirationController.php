<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AspirationController extends Controller
{
    // ADMIN - LIST (SEARCH + FILTER)
    public function index(Request $request)
    {
        // ambil kategori buat filter
        $categories = Category::orderBy('name')->get();

        $aspirations = Aspiration::with(['user', 'category'])
            ->when($request->search, function ($q) use ($request) {
                $q->whereHas('user', function ($u) use ($request) {
                    $u->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhere('lokasi', 'like', '%' . $request->search . '%')
                ->orWhere('keterangan', 'like', '%' . $request->search . '%');
            })
            ->when($request->category, function ($q) use ($request) {
                $q->whereIn('category_id', $request->category);
            })
            ->when($request->status, function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.daftarpengaduan', compact('aspirations', 'categories'));
    }

    // ADMIN - DETAIL
    public function show(Aspiration $aspiration)
    {
        return view('admin.aspiration.show', compact('aspiration'));
    }

    // USER - FORM
    public function create()
    {
        $categories = Category::all();
        return view('user.aspirasi', compact('categories'));
    }

    // USER - STORE
    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required',
            'tanggal'     => 'required|date',
            'category_id' => 'required',
            'lokasi'      => 'required',
            'keterangan'  => 'required',
            'bukti'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $bukti = null;
        if ($request->hasFile('bukti')) {
            $bukti = $request->file('bukti')->store('bukti', 'public');
        }

        Aspiration::create([
            'user_id'     => auth()->id(),
            'category_id' => $request->category_id,
            'nama'        => $request->nama,
            'tanggal'     => $request->tanggal,
            'lokasi'      => $request->lokasi,
            'keterangan'  => $request->keterangan,
            'bukti'       => $bukti,
        ]);

        return back()->with('success', 'Pengaduan berhasil dikirim');
    }

    // ADMIN - UPDATE STATUS
    public function update(Request $request, Aspiration $aspiration)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak'
        ]);

        $aspiration->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status berhasil diubah');
    }

    // ADMIN - DELETE
    public function destroy(Aspiration $aspiration)
    {
        if ($aspiration->bukti) {
            Storage::disk('public')->delete($aspiration->bukti);
        }

        $aspiration->delete();

        return back()->with('success', 'Pengaduan berhasil dihapus');
    }

    // USER - RIWAYAT PENGADUAN SENDIRI
    public function myAspiration(Request $request)
    {
        // ambil kategori (ID + NAMA)
        $categories = Category::orderBy('name')->get();

        $aspirations = Aspiration::where('user_id', auth()->id())
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('information', 'like', '%' . $request->search . '%');
            })
            ->when($request->category, function ($q) use ($request) {
                $q->whereIn('category_id', $request->category); // ⬅️ FIX
            })
            ->with('category')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('user.riwayat', compact('aspirations', 'categories'));
    }
}
