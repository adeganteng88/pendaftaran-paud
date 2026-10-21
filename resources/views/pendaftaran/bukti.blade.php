<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran PAUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-success text-white text-center py-3">
                    <h4 class="mb-0 fw-bold">Bukti Pendaftaran Berhasil</h4>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-info text-center">
                        Simpan lembar bukti ini sebagai tanda pendaftaran online PAUD.
                    </div>

                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">ID Pendaftaran</th>
                            <td>: #{{ $pendaftaran->id_pendaftaran }}</td>
                        </tr>
                        <tr>
                            <th>Nama Siswa</th>
                            <td>: {{ $pendaftaran->nama_siswa }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>: {{ $pendaftaran->nik }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tgl Lahir</th>
                            <td>: {{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Nama Wali</th>
                            <td>: {{ $pendaftaran->wali->nama_wali }}</td>
                        </tr>
                        <tr>
                            <th>No HP Wali</th>
                            <td>: {{ $pendaftaran->wali->no_hp }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Daftar</th>
                            <td>: {{ $pendaftaran->tanggal_daftar }}</td>
                        </tr>
                        <tr>
                            <th>Status Validasi</th>
                            <td>: 
                                <span class="badge bg-warning text-dark">{{ ucfirst($pendaftaran->status_validasi) }}</span>
                            </td>
                        </tr>
                    </table>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('pendaftaran.form') }}" class="btn btn-outline-secondary">Kembali ke Form</a>
                        <button onclick="window.print()" class="btn btn-primary">Cetak Bukti</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>