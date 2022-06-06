<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index()
    {
        $status = 0;
        $user_id = auth()->user()->id;

        if ($pengajuan_terakhir = DB::table('tbl_pengajuan')
            ->where('user_id', $user_id)
            ->orderBy('id', 'desc')
            ->first()
        ) {
            $status = $pengajuan_terakhir->status;
        }


        return view('user.index', [
            'pengajuan' => $pengajuan_terakhir,
            'status' => $status
        ]);
    }



    public function profil()
    {
        $user = Auth::user();
        return view('user.profile', [
            'user' => $user
        ]);
    }

    public function password()
    {
        $user = Auth::user();
        return view('user.ubah_password', [
            'user' => $user
        ]);
    }
    public function data()
    {
        $user = Auth::user();
        return view('user.ubah_data', [
            'user' => $user
        ]);
    }
    public function edit_password(Request $request)
    {
        $request->validate([
            'password1' => ['required', new MatchOldPassword],
            'password2' => ['required'],
            'password3' => ['same:password2'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->password2)]);

        return redirect()->route('profil')->with('status', 'Password berhasil diubah!');
    }

    public function edit_data(Request $request)
    {

        try {
            $user = User::find(auth()->user()->id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->kontak = $request->kontak;
            $user->save();

            return redirect()->route('profil')->with('status', 'Data berhasil diubah!');
        } catch (\Throwable $th) {
            return redirect()->route('profil')->with('status', 'Terjadi Kesalahan!');
        }
    }



    public function tambah()
    {
        return view('user.tambah_user');
    }

    public function insert(Request $req)
    {
        try {

            $user = User::create([
                'name' => $req->name,
                'email' => $req->email,
                'jenis_kelamin' => $req->jenis_kelamin,
                'divisi' => $req->divisi,
                'jabatan' => $req->jabatan,
                'kontak' => $req->kontak,
            ])->assignRole($req->roles);

            createCuti($user->id, $req->jenis_kelamin);

            $password = $req->roles . "gyd" . $user->id;
            $id_karyawan = "GYD-" . strtoupper(Str::random(3)) . $user->id;
            $user->password = Hash::make($password);
            $user->id_karyawan = $id_karyawan;
            $user->save();
            return redirect()->route('admin')->with('status', 'User berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('admin')->with('status', 'Terjadi kesalahan');
        }
    }

    public function update(Request $req)
    {
        try {
            $user = User::find($req->id);
            $user->update([
                'divisi' => $req->divisi,
                'jabatan' => $req->jabatan,
            ]);
            $user->assignRole($req->roles);
            return redirect()->route('all')->with('status', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin')->with('status', 'Terjadi kesalahan');
        }
    }
}
