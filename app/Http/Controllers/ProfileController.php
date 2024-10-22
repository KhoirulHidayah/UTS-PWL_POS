<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function edit()
    {
        // Mengambil data user yang sedang login
        $user = auth()->user();
        
        // Mengirimkan data user ke view
        return view('profile.edit', compact('user'));
    }

    // Metode untuk memperbarui foto profil
    public function update(Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $user = auth()->user();
    
        if ($request->hasFile('avatar')) {
            $avatarName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('images'), $avatarName);
            $user->avatar = $avatarName;
            $user->save();
        }
    
        return redirect()->route('profile.update')->with('success', 'Foto profil berhasil diperbarui!');
    }
}