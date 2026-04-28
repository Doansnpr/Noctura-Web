<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AkunController extends Controller
{
    public function index()
    {
        $accounts = Akun::all()->map(function ($a) {
            return $this->formatAkun($a);
        });

        return view('akun.index', compact('accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'email'    => 'required|email|unique:akun,email',
            'role'     => 'required|in:admin,pengguna',
            'password' => 'required|string|min:6',
            'profile.full_name' => 'nullable|string',
            'profile.gender'    => 'nullable|in:L,P',
            'profile.phone'     => 'nullable|string',
        ]);

        $akun = Akun::create([
            'username'   => $request->username,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => $request->role,
            'profile'    => [
                'full_name' => $request->input('profile.full_name', ''),
                'gender'    => $request->input('profile.gender', ''),
                'phone'     => $request->input('profile.phone', ''),
            ],
            'created_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Akun berhasil ditambahkan.',
            'data'    => $this->formatAkun($akun)
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $akun = Akun::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:100',
            'email'    => ['required', 'email', Rule::unique('akun', 'email')->ignore($akun->_id, '_id')],
            'role'     => 'required|in:admin,pengguna',
            'password' => 'nullable|string|min:6',
            'profile.full_name' => 'nullable|string',
            'profile.gender'    => 'nullable|in:L,P',
            'profile.phone'     => 'nullable|string',
        ]);

        $data = [
            'username' => $request->username,
            'email'    => $request->email,
            'role'     => $request->role,
            'profile'  => [
                'full_name' => $request->input('profile.full_name', ''),
                'gender'    => $request->input('profile.gender', ''),
                'phone'     => $request->input('profile.phone', ''),
            ],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $akun->update($data);
        $akun->refresh();

        return response()->json([
            'success' => true,
            'message' => 'Akun berhasil diperbarui.',
            'data'    => $this->formatAkun($akun)
        ]);
    }

    public function destroy(string $id)
    {
        $akun = Akun::findOrFail($id);
        $akun->delete();

        return response()->json([
            'success' => true,
            'message' => 'Akun berhasil dihapus.',
            'data'    => ['id' => $id]
        ]);
    }

    private function formatAkun($akun)
    {
        return [
            'id'        => (string) $akun->_id,
            'name'      => $akun->username,
            'email'     => $akun->email,
            'role'      => $akun->role === 'admin' ? 'Admin' : 'Pengguna',
            'createdAt' => $akun->created_at
                            ? $akun->created_at->toIso8601String()
                            : now()->toIso8601String(),
            'profile'   => [
                'full_name' => $akun->profile['full_name'] ?? '',
                'gender'    => $akun->profile['gender'] ?? '',
                'phone'     => $akun->profile['phone'] ?? '',
            ],
        ];
    }
}