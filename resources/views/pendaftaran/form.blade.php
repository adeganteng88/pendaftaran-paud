<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran PAUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">PAUD Online</a>
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm fw-bold">Login Admin</a>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h3 class="mb-0 fw-bold">Form Pendaftaran Siswa Baru</h3>
                </div>
                <div class="card-body p-4">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h5 class="fw-bold text-primary mb-3">Data Orang Tua / Wali</h5>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Wali</label>
                            <input type="text" name="nama_wali" class="form-control" value="{{ old('nama_wali') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">No HP/WA</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat Wali</label>
                            <textarea name="alamat_wali" class="form-control" rows="2" required>{{ old('alamat_wali') }}</textarea>
                        </div>

                        <hr class="my-4">

                        <h5 class="fw-bold text-primary mb-3">Data Siswa</h5>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Siswa</label>
                            <input type="text" name="nama_siswa" class="form-control" value="{{ old('nama_siswa') }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">NIK (16 Digit)</label>
                                <input type="text" name="nik" class="form-control" maxlength="16" value="{{ old('nik') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="" disabled selected>-- Pilih --</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat Siswa</label>
                            <textarea name="alamat_siswa" class="form-control" rows="2" required>{{ old('alamat_siswa') }}</textarea>
                        </div>

                        <hr class="my-4">

                        <h5 class="fw-bold text-primary mb-3">Upload Berkas Persyaratan</h5>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Upload Foto/Dokumen (Bisa pilih banyak file sekaligus)</label>
                            <!-- Input multiple berkas[] -->
                            <input type="file" name="berkas[]" class="form-control" multiple required>
                            <small class="text-muted">*Tahan tombol ctrl\tekan lama untuk memilih lebih dari 1 foto</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 btn-lg fw-bold">Kirim Pendaftaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>