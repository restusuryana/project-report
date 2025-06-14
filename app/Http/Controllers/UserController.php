<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
class UserController extends Controller
{
   public function index()
   {
      $users = User::all();
      return view('pageadmin.user.index', compact('users'));
   }

   public function create()
   {
      return view('pageadmin.user.create');
   }

   public function store(Request $request)
   {
      $request->validate([
         'name' => 'required',
         'email' => 'required|email|unique:users',
         'password' => 'required|min:8|confirmed',
         'role' => 'required',
      ], [
         'name.required' => 'Nama wajib diisi',
         'email.required' => 'Email wajib diisi',
         'email.email' => 'Format email tidak valid',
         'email.unique' => 'Email sudah terdaftar',
         'password.required' => 'Password wajib diisi',
         'password.min' => 'Password minimal 8 karakter',
         'password.confirmed' => 'Konfirmasi password tidak cocok',
         'role.required' => 'Role wajib diisi'
      ]);

      try {
         $data = $request->all();
         $data['password'] = Hash::make($request->password);
         User::create($data);
         Alert::success('Berhasil', 'User berhasil ditambahkan');
         return redirect()->route('users.index');
      } catch (\Exception $e) {
         Alert::error('Gagal', 'Terjadi kesalahan saat menambahkan user');
         return redirect()->back()->withInput();
      }
   }

   public function edit($id)
   {
      $user = User::find($id);
      return view('pageadmin.user.edit', compact('user'));
   }

   public function update(Request $request, $id)
   {
      $user = User::find($id);
      
      $data = $request->all();
      
      // Update password hanya jika ada input password baru
      if($request->filled('password')) {
         $data['password'] = Hash::make($request->password);
      } else {
         unset($data['password']);
      }
      
      $user->update($data);
      Alert::success('Success', 'User berhasil diupdate');
      return redirect()->route('users.index');
   }

   public function destroy($id)
   {
      $user = User::find($id);
      $user->delete();
      Alert::success('Success', 'User berhasil dihapus');
      return redirect()->route('users.index');
   }
}
