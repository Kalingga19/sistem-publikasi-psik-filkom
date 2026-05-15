<?php //controller header , update user

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('nim', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->role) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(5)->withQueryString();

        return view('data.data-pengguna', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'nim'      => 'required|unique:users,nim',
            'email'    => [
                'required',
                'email',
                'unique:users,email',
                function ($attribute, $value, $fail) {
                    if (!str_ends_with($value, '@student.ub.ac.id')) {
                        $fail('Email harus menggunakan domain @student.ub.ac.id');
                    }
                },
            ],
            'role'     => 'required|in:admin,user',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name'     => $request->name,
            'nim'      => $request->nim,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'nim'   => 'required|unique:users,nim,' . $id,
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $id,
                function ($attribute, $value, $fail) {
                    if (!str_ends_with($value, '@student.ub.ac.id')) {
                        $fail('Email harus menggunakan domain @student.ub.ac.id');
                    }
                },
            ],
            'role'     => 'required|in:admin,user',
            'password' => 'nullable|min:8',
        ]);

        $user->name  = $request->name;
        $user->nim   = $request->nim;
        $user->email = $request->email;
        $user->role  = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cegah admin hapus diri sendiri
        if (Auth::id() == $id) {
            return redirect()->route('users.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        User::findOrFail($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }

    public function editProfile()
    {
        return view('profile.edit');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $user->id,
                function ($attribute, $value, $fail) {
                    if (!str_ends_with($value, '@student.ub.ac.id')) {
                        $fail('Email harus menggunakan domain @student.ub.ac.id');
                    }
                },
            ],
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('profile_success', 'Profil berhasil diperbarui!');
    }
}