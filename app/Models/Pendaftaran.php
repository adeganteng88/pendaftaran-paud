<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $primaryKey = 'id_pendaftaran';
    protected $fillable = [
        'id_wali', 'id_user', 'nama_siswa', 'nik', 'tempat_lahir',
        'tanggal_lahir', 'jenis_kelamin', 'alamat', 'tanggal_daftar',
        'berkas_persyaratan', 'status_validasi'
    ];

    public function wali()
    {
        return $this->belongsTo(Wali::class, 'id_wali', 'id_wali');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
