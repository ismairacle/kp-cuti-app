<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index',[
            'data_pengajuan' => Pengajuan::all()
        ]);
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('admin.user_detail', [
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user_edit', [
            'user' => $user
        ]);
    }

    public function all()
    {
        return view('admin.all',[
        'data_karyawan' => User::all()
        ]);
    }


}
