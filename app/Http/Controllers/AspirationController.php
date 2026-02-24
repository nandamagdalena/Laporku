<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\StoreAspirationRequest;

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
                ->orWhere('location', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
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

        return view('admin.aspiration.index', compact('aspirations', 'categories'));
    }

    // ADMIN - DETAIL
    public function show(Aspiration $aspiration)
    {
        return view('admin.aspiration.show', compact('aspiration'));
    }

    // USER - DETAIL
    public function showUser(Aspiration $aspiration)
    {
        return view('user.aspiration.show', compact('aspiration'));
    }

    // USER - FORM
    public function create()
    {
        $categories = Category::all();
        return view('user.aspiration.create', compact('categories'));
    }

    // USER - STORE
    public function store(StoreAspirationRequest $request)
    {
        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('bukti', 'public');
        }

        Aspiration::create([
            'user_id'     => auth()->id(),
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'date'        => $request->date,
            'location'    => $request->location,
            'description' => $request->description,
            'image'       => $image,
        ]);

        return back()->with('success', 'Pengaduan berhasil dikirim');
    }

    // ADMIN - UPDATE STATUS
    public function update(Request $request, Aspiration $aspiration)
    {
        $request->validate([
            'status'    => 'required|in:menunggu,diproses,selesai,ditolak',
            'response'  => 'nullable|string'
        ]);

        $aspiration->update([
            'status'    => $request->status,
            'response' => $request->response,
        ]);

        return back()->with('success', 'Status dan tanggapan berhasil disimpan');
    }

    // ADMIN & USER - DELETE
    public function destroy(Aspiration $aspiration)
    {
        if ($aspiration->image) {
            Storage::disk('public')->delete($aspiration->image);
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
                ->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->when($request->category, function ($q) use ($request) {
                $q->whereIn('category_id', $request->category); // ⬅️ FIX
            })
            ->with('category')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('user.aspiration.index', compact('aspirations', 'categories'));
    }

    public function edit(Aspiration $aspiration)
    {
        //
    }

    public function export($id)
    {
        $aspiration = Aspiration::with('user', 'category')->findOrFail($id);

        $pdf = Pdf::loadView('admin.aspiration.export', compact('aspiration'))
                ->setPaper('A4', 'portrait');

        return $pdf->download('laporan-pengaduan-'.$aspiration->id.'.pdf');
    }

}
