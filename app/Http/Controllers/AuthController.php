<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {

            $role = Auth::user()->role;

            if ($role === 'admin' || $role === 'superadmin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'user') {
                return redirect()->route('user.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('login')
                    ->with('error', 'Role tidak dikenali.');
            }
        }

        return view('auth.login');
    }

    public function loginProses(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin') {
                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Selamat datang Admin!');
            } elseif (Auth::user()->role === 'user') {
                return redirect()->intended(route('user.dashboard'))
                    ->with('success', 'Selamat datang User!');
            } else {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('error', 'Role tidak dikenali.');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput($request->only('email'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
    public function create()
    {
        return view('admin.akun.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:user,admin',
            'alamat' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'foto' => 'nullable|image|max:2048',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'foto' => $request->foto ? $request->file('foto')->store('foto', 'public') : null,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('admin.user.index')
            ->with('success_user', 'Akun user berhasil dibuat.');
    }
    public function index()
    {
        $users = User::orderByRaw("role = 'admin' DESC")
            ->latest()
            ->paginate(10);
        return view('admin.akun.index', compact('users'));
    }
}
