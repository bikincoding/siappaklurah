<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banjar;
use App\Models\KepalaLingkungan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $users = User::with(['banjar', 'kepala_lingkungan'])
        ->leftJoin('kepala_lingkungans', 'users.id_kepala_lingkungans', '=', 'kepala_lingkungans.id')
        ->orderBy('users.role')
        ->orderBy('kepala_lingkungans.nama_kepala_lingkungan')
        ->select('users.*') // Ensure that only user columns are selected
        ->get();
        return view('admin.users.index', compact('users'));
   
    }

    // Tampilkan form untuk membuat user baru
    public function create()
    {
        $banjars = Banjar::all();
        $biodatas = KepalaLingkungan::all();
        return view('admin.users.create', compact('banjars','biodatas'));
    }

    // Simpan user baru ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'id_kepala_lingkungans' => 'required',
            'role' => 'required|string|in:user,admin',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_kepala_lingkungans' => $request->id_kepala_lingkungans,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Tampilkan form untuk mengedit user tertentu
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $biodatas = KepalaLingkungan::all();
        return view('admin.users.edit', compact('user','biodatas'));
    }

    public function form_reset_password($id)
    {
        $user = User::with(['banjar', 'kepala_lingkungan'])->findOrFail($id);
        return view('user.reset_password', compact('user'));

        // echo $id;
    }

    // Update user tertentu di database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
         
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'id_kepala_lingkungans' => 'required',
            'role' => 'required|string|in:user,admin',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);
        $user->update($request->only(['email', 'id_kepala_lingkungans', 'role']));

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function changePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user')->with('success', 'Password changed successfully.');
    }

    public function changePassword2(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard_user')->with('success', 'Password changed successfully.');
    }

    // Tampilkan detail user tertentu
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    // Hapus user tertentu dari database
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}