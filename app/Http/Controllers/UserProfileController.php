<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\LevelModel;

class UserProfileController extends Controller
{
    // Menampilkan form untuk memperbarui data diri
    public function updateDataDiri()
    {
        $levels = LevelModel::all(); // Mengambil semua data level dari database
        return view('user_profile.updatedatadiri', compact('levels'));
    }

    // Menyimpan pembaruan data diri
    public function storeUpdateDataDiri(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'level_id' => 'required|exists:m_level,level_id', // Validasi level_id
        ]);

        // Mendapatkan pengguna yang sedang login
        $user = auth()->user();

        // Memperbarui data pengguna
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->level_id = $request->level_id; // Simpan level_id yang dipilih
        $user->save(); // Simpan perubahan ke database

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data diri berhasil diperbarui.');
    }
}
