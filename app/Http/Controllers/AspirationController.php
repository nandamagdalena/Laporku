<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AspirationController extends Controller
{
    // ADMIN - LIST
    public function index()
    {
        $aspirations = Aspiration::with(['user', 'category'])
            ->latest()
            ->paginate(10);

        return view('admin.aspiration.index', compact('aspirations'));
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
    public function myAspiration()
    {
        $aspirations = Aspiration::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.riwayat', compact('aspirations'));
    }
}
