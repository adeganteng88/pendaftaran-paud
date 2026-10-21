<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class AdminPendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::with('wali')->latest()->get();
        return view('admin.dashboard', compact('pendaftarans'));
    }

    public function validasi(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'status_validasi' => $request->status_validasi,
            'id_user'         => Auth::id(), // ID Admin yang memvalidasi
        ]);

        return back()->with('success', 'Status validasi berhasil diperbarui!');
    }
}