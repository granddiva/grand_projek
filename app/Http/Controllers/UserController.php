<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil request search & filter
        $search = $request->input('search');
        $filter = $request->input('filter');

        // Query
        $users = User::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        })
        ->when($filter, function ($query, $filter) {
            if ($filter == 'gmail') {
                $query->where('email', 'like', '%gmail.com');
            } elseif ($filter == 'yahoo') {
                $query->where('email', 'like', '%yahoo.com');
            } elseif ($filter == 'outlook') {
                $query->where('email', 'like', '%outlook.com');
            }
        })
        ->orderBy('id', 'desc')
        ->paginate(10)
        ->withQueryString();

        return view('guest/user.index', compact('users', 'search', 'filter'));
    }

    public function create()
    {
        return view('guest/user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('guest/user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
