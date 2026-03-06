<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; 

class ProfileController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('profile.index', [
            'user' => $user
        ]);
    }

    public function edit()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('profile.edit', [
            'user' => $user
        ]);
    }

    // METHOD 1: Update Data Diri 
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255|unique:users,email,' . $user->id, 
            'alamat' => 'nullable|string|max:100',
            'phone'  => 'nullable|string|max:20',
            'foto'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->alamat = $request->alamat;
        $user->phone  = $request->phone;
        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $user->foto = $request->file('foto')->store('foto', 'public');
        }

        $user->save();

        return redirect()->route('profile.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    // METHOD 2: Khusus Ganti Password
    public function editPassword()
{
    return view('profile.password_edit', [
        'user' => Auth::user()
    ]);
}
    public function updatePassword(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|current_password', 
            'password' => 'required|min:6|confirmed|different:current_password',
        ], [
            'current_password.current_password' => 'Password lama yang Anda masukkan salah.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.different' => 'Password baru tidak boleh sama dengan password lama.',
        ]);
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diganti.');
    }
}