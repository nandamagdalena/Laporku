<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kategori | Laporku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
            font-family: 'Segoe UI', sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: #ffffff;
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px;
            border-right: 1px solid #eaeaea;
            display: flex;
            flex-direction: column;
        }

        .sidebar img {
            display: block;
            margin: -60px auto 20px;
            width: 240px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            margin-bottom: 6px;
            border-radius: 14px;
            color: #555;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: #eef3ff;
            color: #0d6efd;
        }

        .menu-atas {
            margin-bottom: 40px;
        }

        /* MAIN */
        .main {
            margin-left: 260px;
            padding: 22px;
        }

        /* TOPBAR */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .breadcrumb-custom {
            display: flex;
            gap: 6px;
            font-size: 12px;
            color: #e63946;
        }

        .user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .icon-bulat {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        /* CARD */
        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 6px 16px rgba(0,0,0,.06);
        }

        /* SEARCH */
        .search-wrapper {
            position: relative;
            max-width: 250px;
            margin-bottom: 15px;
        }

        .search-wrapper input {
            width: 100%;
            font-size: 13px;
            padding: 6px 10px 6px 30px;
            border-radius: 8px;
            border: 1px solid #ced4da;
        }

        .search-wrapper .fa-search {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #6c757d;
        }

        /* TABLE */
        .table thead th {
            background-color: #0d6efd;
            color: #fff;
            text-align: center;
        }

        .table tbody td {
            text-align: center;
            font-size: 13px;
        }

        .action-btn {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 12px;
            cursor: pointer;
        }

        .btn-edit { background: #fcbf49; }
        .btn-delete { background: #ef233c; }

        /* ===== MODAL HAPUS (PERSIS FOTO) ===== */
        .modal-hapus .modal-content{
            border-radius:22px;
            padding:28px;
            text-align:center;
        }

        .icon-trash-hapus{
            width:80px;
            height:80px;
            margin:0 auto 16px;
            background:#ffe6e6;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .icon-trash-hapus i{
            font-size:38px;
            color:#ef233c;
        }

        .modal-hapus h5{
            font-weight:600;
            margin-bottom:6px;
        }

        .modal-hapus p{
            font-size:13px;
            color:#6c757d;
        }

        .modal-hapus p span{
            color:#ef233c;
            font-weight:500;
        }

        .btn-batal-hapus{
            border:1.5px solid #ef233c;
            color:#ef233c;
            background:#fff;
            border-radius:10px;
            padding:6px 22px;
        }

        .btn-confirm-hapus{
            background:#d90429;
            color:#fff;
            border-radius:10px;
            padding:6px 26px;
        }

    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="menu-atas">
        <img src="{{ asset('img/logo.png') }}">

        <a href="#"><i class="fas fa-home"></i> Dashboard</a>

        <small class="text-muted px-3 mt-3">Pengguna</small>
        <a href="#"><i class="fas fa-users"></i> Daftar Pengguna</a>

        <small class="text-muted px-3 mt-3">Pengaduan</small>
        <a href="#"><i class="fas fa-file-alt"></i> Daftar Pengaduan</a>

        <small class="text-muted px-3 mt-3">Kategori</small>
        <a href="#" class="active"><i class="fas fa-file-alt"></i> Kategori</a>
    </div>
</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <div>
            <h6>Kategori</h6>
            <div class="breadcrumb-custom">
                <i class="fas fa-home"></i>
                <span>Beranda</span>
                <span>></span>
                <b>Kategori</b>
            </div>
        </div>

        <div class="user">
            <div class="text-end">
                <div class="fw-semibold">Admin Sarpras</div>
                <small class="text-muted">admin.sarpras@laporku.id</small>
            </div>
            <img src="{{ asset('img/iconorang.png') }}" class="icon-bulat">
        </div>
    </div>

    <!-- TOMBOL TAMBAH -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary btn-sm" id="addBtn">
            <i class="fas fa-plus"></i> Tambah Kategori
        </button>
    </div>

    <!-- CARD -->
    <div class="card p-3">

        <div class="search-wrapper">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Telusuri...">
        </div>

        <table class="table align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Dibuat Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="kategoriTable"></tbody>
        </table>

    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambahKategori" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0">
                <h6 class="modal-title">Tambah Kategori</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-0">
                <p class="text-muted" style="font-size:13px">
                    Tambahkan kategori yang Anda inginkan.
                </p>
                <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" id="namaKategoriInput" class="form-control form-control-sm"
                       placeholder="Masukkan nama kategori">
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary btn-sm" id="simpanKategori">Tambah</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEditKategori" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0">
                <h6 class="modal-title">Edit Kategori</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
        <div class="modal-body pt-0">
                <p class="text-muted" style="font-size:13px">
                    Edit kategori yang anda buat
                </p>
            </div>
            <div class="modal-body pt-0">
                <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" id="editKategoriInput" class="form-control form-control-sm">
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-warning btn-sm" id="updateKategori">Edit</button>
            </div>
        </div>
    </div>
</div>


<!-- MODAL HAPUS -->
<div class="modal fade modal-hapus" id="modalHapusKategori" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="icon-trash-hapus">
                <i class="fas fa-trash"></i>
            </div>

            <h5>Hapus Data?</h5>
            <p>
                Data yang Anda pilih akan dihapus secara
                <span>permanen</span> dan tidak dapat dikembalikan.
            </p>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <button class="btn btn-batal-hapus" data-bs-dismiss="modal">
                    Batalkan
                </button>
                <button class="btn btn-confirm-hapus" id="confirmHapus">
                    Hapus
                </button>
            </div>

        </div>
    </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
let kategoriData = [
    {nama:'Kelas 1',tanggal:'12-10-2025'},
    {nama:'Kelas 2',tanggal:'12-10-2025'},
    {nama:'Toilet',tanggal:'12-10-2025'},
    {nama:'Kelas 3',tanggal:'13-10-2025'},
    {nama:'Kelas 4',tanggal:'14-10-2025'},
    {nama:'Toilet 5',tanggal:'15-10-2025'}
];

let filteredKategori = [...kategoriData];
let indexEdit = null;

function renderTable() {
    const tbody = document.getElementById('kategoriTable');
    tbody.innerHTML = '';
    filteredKategori.forEach((item, i) => {
        tbody.innerHTML += `
        <tr>
            <td>${i + 1}</td>
            <td>${item.nama}</td>
            <td>${item.tanggal}</td>
            <td>
                <span class="action-btn btn-edit" onclick="editKategori(${i})">
                    <i class="fas fa-pen"></i>
                </span>
                <span class="action-btn btn-delete" onclick="hapusKategori(${i})">
                    <i class="fas fa-trash"></i>
                </span>
            </td>
        </tr>`;
    });
}

const modalTambah = new bootstrap.Modal(document.getElementById('modalTambahKategori'));
const modalEdit = new bootstrap.Modal(document.getElementById('modalEditKategori'));

document.getElementById('addBtn').onclick = () => {
    document.getElementById('namaKategoriInput').value = '';
    modalTambah.show();
};

document.getElementById('simpanKategori').onclick = () => {
    const nama = document.getElementById('namaKategoriInput').value.trim();
    if (!nama) return alert('Nama kategori wajib diisi');

    kategoriData.push({
        nama: nama,
        tanggal: new Date().toLocaleDateString('id-ID')
    });

    filteredKategori = [...kategoriData];
    renderTable();
    modalTambah.hide();
};

function editKategori(index) {
    indexEdit = index;
    document.getElementById('editKategoriInput').value = filteredKategori[index].nama;
    modalEdit.show();
}

document.getElementById('updateKategori').onclick = () => {
    const namaBaru = document.getElementById('editKategoriInput').value.trim();
    if (!namaBaru) return alert('Nama kategori wajib diisi');

    filteredKategori[indexEdit].nama = namaBaru;
    kategoriData[indexEdit].nama = namaBaru;
    renderTable();
    modalEdit.hide();
};

function hapusKategori(index) {
    indexHapus = index;
    new bootstrap.Modal(
        document.getElementById('modalHapusKategori')
    ).show();
}

document.getElementById('confirmHapus').onclick = () => {
    kategoriData.splice(indexHapus, 1);
    filteredKategori.splice(indexHapus, 1);
    renderTable();
    bootstrap.Modal.getInstance(
        document.getElementById('modalHapusKategori')
    ).hide();
};

/* ===== SEARCH (DITAMBAHKAN, TIDAK MENGUBAH KODE LAIN) ===== */
document.getElementById('searchInput').addEventListener('input', function () {
    const keyword = this.value.toLowerCase();
    filteredKategori = kategoriData.filter(item =>
        item.nama.toLowerCase().includes(keyword)
    );
    renderTable();
});

renderTable();
</script>

</body>
</html>
