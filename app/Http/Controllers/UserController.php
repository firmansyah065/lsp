<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display all members (Admin)
     */
    public function indexMembers()
    {
        $members = User::where('role', 'siswa')->get();
        return view('admin.members.index', compact('members'));
    }

    /**
     * Show form for adding new member
     */
    public function createMember()
    {
        return view('admin.members.create');
    }

    /**
     * Store new member (Admin)
     */
    public function storeMember(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:users|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'username' => 'required|unique:users|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'siswa';

        User::create($validated);

        return redirect()->route('members.index')
                       ->with('success', 'Anggota berhasil ditambahkan!');
    }

    /**
     * Show form for editing member
     */
    public function editMember(User $user)
    {
        return view('admin.members.edit', compact('user'));
    }

    /**
     * Update member (Admin)
     */
    public function updateMember(Request $request, User $user)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:users,nis,' . $user->id . '|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'username' => 'required|unique:users,username,' . $user->id . '|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        if ($validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('members.index')
                       ->with('success', 'Anggota berhasil diperbarui!');
    }

    /**
     * Delete member
     */
    public function destroyMember(User $user)
    {
        $user->delete();

        return redirect()->route('members.index')
                       ->with('success', 'Anggota berhasil dihapus!');
    }

    /**
     * Show registration form for student
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle student registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:users|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'username' => 'required|unique:users|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'siswa';

        $user = User::create($validated);

        // Auto login after registration
        Auth::login($user);

        return redirect()->intended('/dashboard/siswa')
                       ->with('success', 'Registrasi berhasil! Selamat datang!');
    }
}
