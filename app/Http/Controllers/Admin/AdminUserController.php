<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->cari, fn($q) => $q->where('name', 'like', '%'.$request->cari.'%')
                ->orWhere('email', 'like', '%'.$request->cari.'%'))
            ->when($request->role, fn($q) => $q->where('role', $request->role))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'address'  => ['nullable', 'string', 'max:500'],
            'role'     => ['required', 'in:admin,customer'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function show(User $pengguna)
    {
        $orders = $pengguna->orders()->latest()->take(5)->get();
        return view('admin.users.show', compact('pengguna', 'orders'));
    }

    public function edit(User $pengguna)
    {
        return view('admin.users.edit', compact('pengguna'));
    }

    public function update(Request $request, User $pengguna)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email,'. $pengguna->id],
            'phone'    => ['nullable', 'string', 'max:20'],
            'address'  => ['nullable', 'string', 'max:500'],
            'role'     => ['required', 'in:admin,customer'],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        // Hanya update password jika diisi
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $pengguna->update($validated);

        return redirect()->route('admin.pengguna.show', $pengguna->id)
            ->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function destroy(User $pengguna)
    {
        if ($pengguna->isAdmin()) {
            return back()->with('error', 'Tidak bisa menghapus akun admin!');
        }
        $pengguna->delete();
        return back()->with('success', 'Pengguna berhasil dihapus!');
    }
}