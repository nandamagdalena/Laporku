@extends('layouts.template')

@section('title', 'Kategori')

@section('content')

{{-- Header --}}
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-xl font-semibold text-gray-800">Kategori</h1>
        <p class="text-sm text-[#00afea]">Kelola kategori pengaduan</p>
    </div>

    <button onclick="openModal()"
            class="bg-green-400 hover:bg-blue-400 text-white px-4 py-2 rounded-lg text-sm">
        <i class="fa-solid fa-plus mr-1"></i>
        Tambah Kategori
    </button>
</div>

{{-- Alert --}}
@if (session('success'))
    <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg text-sm">
        {{ session('success') }}
    </div>
@endif

{{-- Table --}}
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-[#02779E] text-white">
            <tr>
                <th class="px-6 py-3 text-left">No</th>
                <th class="px-6 py-3 text-left">Nama Kategori</th>
                <th class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($categories as $category)
                <tr>
                    <td class="px-6 py-4">{{ $categories->firstItem() + $loop->index }}</td>
                    <td class="px-6 py-4">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-center flex justify-center gap-3">

                        {{-- Edit --}}
                        <button onclick="openEditModal({{ $category->id }}, '{{ $category->name }}')"
                                class="text-yellow-500 hover:text-yellow-600">
                            <i class="fa-solid fa-pen"></i>
                        </button>

                        {{-- Delete --}}
                        <form action="{{ route('category.destroy', $category) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                type="button"
                                onclick="openDeleteModal('{{ route('category.destroy', $category) }}')"
                                class="text-red-500 hover:text-red-600">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-6 text-center text-gray-500">
                        Data kategori belum tersedia
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $categories->links('pagination') }}
</div>

{{-- MODAL TAMBAH --}}
<div id="modalTambah"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-md rounded-xl p-6">
        <h2 class="text-lg font-semibold mb-1">Tambah Kategori</h2>
        <p class="text-sm text-gray-500 mb-4">Tambahkan kategori yang Anda inginkan.</p>

        <form action="{{ route('category.store') }}" method="POST">
            @csrf

            <label class="text-sm font-medium">
                Nama Kategori <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" required
                   class="w-full mt-1 px-3 py-2 border rounded-lg text-sm"
                   placeholder="Masukkan nama kategori">

            <div class="flex justify-end gap-2 mt-6">
                <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-400 text-white rounded-lg text-sm">
                    Batal
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="modalEdit"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-md rounded-xl p-6">
        <h2 class="text-lg font-semibold mb-4">Edit Kategori</h2>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="name" id="editName"
                   class="w-full px-3 py-2 border rounded-lg text-sm">

            <div class="flex justify-end gap-2 mt-6">
                <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-400 text-white rounded-lg text-sm">
                    Batal
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL DELETE --}}
<div id="modalDelete"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-sm rounded-2xl p-6 text-center">
        {{-- Icon --}}
        <div class="flex justify-center mb-4">
            <div class="bg-red-100 p-4 rounded-xl">
                <i class="fa-solid fa-trash text-red-600 text-3xl"></i>
            </div>
        </div>

        {{-- Text --}}
        <h2 class="text-lg font-semibold text-gray-800">Hapus Data?</h2>
        <p class="text-sm text-gray-500 mt-1">
            Data yang Anda pilih akan dihapus<br>
            secara <span class="font-medium">permanen</span> dan tidak dapat dikembalikan.
        </p>

        {{-- Button --}}
        <div class="flex justify-center gap-3 mt-6">
            <button onclick="closeDeleteModal()"
                    class="px-4 py-2 border border-red-400 text-red-500 rounded-lg text-sm">
                Batalkan
            </button>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

{{-- JS --}}
<script>
    function openModal() {
        modalTambah.classList.remove('hidden')
        modalTambah.classList.add('flex')
    }

    function closeModal() {
        modalTambah.classList.add('hidden')
        modalTambah.classList.remove('flex')
    }

    function openEditModal(id, name) {
        document.getElementById('editName').value = name
        document.getElementById('editForm').action =
            `/admin/categories/${id}`

        modalEdit.classList.remove('hidden')
        modalEdit.classList.add('flex')
    }

    function closeEditModal() {
        modalEdit.classList.add('hidden')
        modalEdit.classList.remove('flex')
    }

    function openDeleteModal(action) {
        document.getElementById('deleteForm').action = action
        modalDelete.classList.remove('hidden')
        modalDelete.classList.add('flex')
    }

    function closeDeleteModal() {
        modalDelete.classList.add('hidden')
        modalDelete.classList.remove('flex')
    }
</script>

@endsection
