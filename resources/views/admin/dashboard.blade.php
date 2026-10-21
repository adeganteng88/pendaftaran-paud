<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PAUD Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

<!-- Navbar Dashboard -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-school me-2"></i>Admin PAUD Online</a>
        <div class="d-flex align-items-center gap-3">
            <span class="text-white small d-none d-md-inline"><i class="fa-solid fa-user-circle me-1"></i> {{ Auth::user()->nama_user ?? 'Admin' }}</span>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm fw-bold"><i class="fa-solid fa-right-from-bracket me-1"></i> Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid px-4 py-4">
    <!-- Header Page -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0 text-dark">Dashboard Kelola Pendaftaran</h3>
            <p class="text-muted small mb-0">Kelola dan verifikasi berkas pendaftaran calon siswa baru.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Statistik Ringkasan Pendaftar -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 bg-white p-3 border-start border-primary border-4">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white p-3 rounded-3 me-3">
                        <i class="fa-solid fa-users fa-xl"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold">Total Pendaftar</span>
                        <h4 class="fw-bold mb-0 text-dark">{{ $pendaftarans->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 bg-white p-3 border-start border-warning border-4">
                <div class="d-flex align-items-center">
                    <div class="bg-warning text-dark p-3 rounded-3 me-3">
                        <i class="fa-solid fa-hourglass-half fa-xl"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold">Menunggu Validasi</span>
                        <h4 class="fw-bold mb-0 text-dark">{{ $pendaftarans->where('status_validasi', 'pending')->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 bg-white p-3 border-start border-success border-4">
                <div class="d-flex align-items-center">
                    <div class="bg-success text-white p-3 rounded-3 me-3">
                        <i class="fa-solid fa-user-check fa-xl"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold">Diterima / Valid</span>
                        <h4 class="fw-bold mb-0 text-dark">{{ $pendaftarans->where('status_validasi', 'valid')->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 bg-white p-3 border-start border-danger border-4">
                <div class="d-flex align-items-center">
                    <div class="bg-danger text-white p-3 rounded-3 me-3">
                        <i class="fa-solid fa-user-xmark fa-xl"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold">Ditolak</span>
                        <h4 class="fw-bold mb-0 text-dark">{{ $pendaftarans->where('status_validasi', 'tidak_valid')->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Pendaftaran -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-list me-2 text-primary"></i>Daftar Calon Siswa</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">#ID</th>
                            <th>Nama Siswa</th>
                            <th>NIK & TTL</th>
                            <th>Nama Wali</th>
                            <th>No HP/WA</th>
                            <th>Berkas (Klik utk lihat)</th>
                            <th>Status Validasi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftarans as $p)
                        <tr>
                            <td class="ps-3 fw-bold">#{{ $p->id_pendaftaran }}</td>
                            <td>
                                <span class="fw-semibold text-dark">{{ $p->nama_siswa }}</span><br>
                                <small class="text-muted">{{ $p->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</small>
                            </td>
                            <td>
                                <small class="fw-semibold">{{ $p->nik }}</small><br>
                                <small class="text-muted">{{ $p->tempat_lahir }}, {{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d-m-Y') }}</small>
                            </td>
                            <td>{{ $p->wali->nama_wali }}</td>
                            <td>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $p->wali->no_hp) }}" target="_blank" class="text-decoration-none text-success fw-semibold">
                                    <i class="fa-brands fa-whatsapp me-1"></i>{{ $p->wali->no_hp }}
                                </a>
                            </td>
                            <td>
                                @if($p->berkas_persyaratan)
                                    @php
                                        $files = json_decode($p->berkas_persyaratan, true) ?? [$p->berkas_persyaratan];
                                    @endphp
                                    
                                    <div class="d-flex flex-wrap gap-1" style="max-width: 220px;">
                                        @foreach($files as $index => $file)
                                            <a href="{{ asset('storage/'.$file) }}" target="_blank" class="btn btn-outline-info btn-sm py-1 px-2 mb-1" style="font-size: 11px;">
                                                <i class="fa-solid fa-file-image me-1"></i>Foto {{ $index + 1 }}
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="badge bg-secondary">Kosong</span>
                                @endif
                            </td>
                            <td>
                                @if($p->status_validasi == 'valid')
                                    <span class="badge bg-success px-3 py-2"><i class="fa-solid fa-circle-check me-1"></i> Valid</span>
                                @elseif($p->status_validasi == 'tidak_valid')
                                    <span class="badge bg-danger px-3 py-2"><i class="fa-solid fa-circle-xmark me-1"></i> Ditolak</span>
                                @else
                                    <span class="badge bg-warning text-dark px-3 py-2"><i class="fa-solid fa-hourglass-half me-1"></i> Pending</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <form action="{{ route('admin.validasi', $p->id_pendaftaran) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status_validasi" value="valid">
                                        <button type="submit" class="btn btn-success btn-sm" title="Terima / Setujui"><i class="fa-solid fa-check"></i></button>
                                    </form>
                                    <form action="{{ route('admin.validasi', $p->id_pendaftaran) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status_validasi" value="tidak_valid">
                                        <button type="submit" class="btn btn-danger btn-sm" title="Tolak"><i class="fa-solid fa-xmark"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i> Belum ada data pendaftaran masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>