<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wali;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    public function create()
    {
        return view('pendaftaran.form');
    }

    public function store(Request $request)
    {
        // Validasi input data lan array berkas
        $request->validate([
            'nama_wali'    => 'required|string|max:255',
            'no_hp'        => 'required|string|max:20',
            'alamat_wali'  => 'required|string',
            'nama_siswa'   => 'required|string|max:255',
            'nik'          => 'required|numeric|digits:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir'=> 'required|date',
            'jenis_kelamin'=> 'required|in:L,P',
            'alamat_siswa' => 'required|string',
            'berkas'       => 'required|array',
            'berkas.*'     => 'file|mimes:pdf,jpg,jpeg,png|max:5048'
        ]);

        $wali = Wali::create([
            'nama_wali' => $request->nama_wali,
            'no_hp'     => $request->no_hp,
            'alamat'    => $request->alamat_wali,
        ]);

        $paths = [];
        if ($request->hasFile('berkas')) {
            foreach ($request->file('berkas') as $file) {
                $paths[] = $file->store('berkas_pendaftaran', 'public');
            }
        }

        $pendaftaran = Pendaftaran::create([
            'id_wali'            => $wali->id_wali,
            'nama_siswa'         => $request->nama_siswa,
            'nik'                => $request->nik,
            'tempat_lahir'       => $request->tempat_lahir,
            'tanggal_lahir'      => $request->tanggal_lahir,
            'jenis_kelamin'      => $request->jenis_kelamin,
            'alamat'             => $request->alamat_siswa,
            'tanggal_daftar'     => now(),
            'berkas_persyaratan' => json_encode($paths),
            'status_validasi'    => 'pending'
        ]);

        return redirect()->route('pendaftaran.bukti', $pendaftaran->id_pendaftaran);
    }

    public function bukti($id)
    {
        $pendaftaran = Pendaftaran::with('wali')->findOrFail($id);
        return view('pendaftaran.bukti', compact('pendaftaran'));
    }
}