<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // ======================
    // HALAMAN TAMPIL PROFIL
    // ======================
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('profile.index', [
            'user' => $user
        ]);
    }

    // ======================
    // HALAMAN FORM EDIT
    // ======================
    public function edit()
    {
        /** @var User $user */
        $user = Auth::user();

        //   return view('profile.index', \compact('user'));
        return view('profile.edit', [
            'user' => $user
        ]);
    }

    // ======================
    // PROSES UPDATE
    // ======================
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:6|confirmed',
            'alamat'=> 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->phone = $request->phone;
        $user->foto = $request->foto ? $request->file('foto')->store('foto', 'public') : null;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
