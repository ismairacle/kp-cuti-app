<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Pengajuan;
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Database\Console\DumpCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use SebastianBergmann\Environment\Console;

class PengajuanController extends Controller
{
    public function pengajuan()
    {
        $result = 4;
        try {
            $user_id = auth()->user()->id;
            $pengajuan_terakhir = DB::table('tbl_pengajuan')
                ->where('user_id', $user_id)
                ->orderBy('id', 'desc')
                ->first();
            $status = $pengajuan_terakhir->status;
            $result = $status;
        } catch (\Throwable $th) {
            $result = 4;
        }

        return view('pengajuan.pengajuan', [
            'status' => $result
        ]);
    }

    public function riwayat()
    {
        $user_id = auth()->user()->id;
        $data_pengajuan = DB::table('tbl_pengajuan')
            ->where('user_id', $user_id)
            ->get();
        return view('pengajuan.riwayat', ['data_pengajuan' => $data_pengajuan]);
    }

    public function status()
    {
        return view('pengajuan.status');
    }

    public function detail($id)
    {
        $pengajuan = Pengajuan::find($id);
        return view('pengajuan.detail', [
            'detail' => $pengajuan
        ]);
    }

    public function delete($id)
    {
        $pengajuan = Pengajuan::find($id);
        $pengajuan->delete();
        return redirect()->route('riwayat');
    }

    public function insert(Request $req)
    {

        $user_id = auth()->user()->id;

        $tgl_mulai = strtotime($req->tgl_mulai);
        $tgl_mulai_date = date('Y-m-d', $tgl_mulai);
        $tgl_selesai = strtotime($req->tgl_selesai);
        $tgl_selesai_date = date('Y-m-d', $tgl_selesai);
        $std = strtotime("+7 day");
        $std_date = date('Y-m-d', $std);
        $lama_pengajuan = 0;

        if ($req->jenis == "Persalinan") {

            $tgl_selesai = strtotime("+90 day", $tgl_mulai);
            $tgl_selesai_date = date('Y-m-d', $tgl_selesai);
            $lama_pengajuan = 1;
        }

        if ($tgl_mulai_date >= $std_date && $tgl_selesai_date >= $tgl_mulai_date) {


            if ($req->jenis != "Persalinan") {
                $lama_pengajuan = date_diff(date_create($tgl_mulai_date), date_create($req->tgl_selesai))->days;
            }

            $pengajuan = new Pengajuan;
            $pengajuan->kode_pengajuan = 'PCGYD-' .  strtoupper(Str::random(4)) .  $user_id;
            $pengajuan->lama_pengajuan = $lama_pengajuan;
            $pengajuan->tgl_mulai = $tgl_mulai_date;
            $pengajuan->tgl_selesai = $tgl_selesai_date;
            $pengajuan->tgl_pengajuan = now();
            $pengajuan->user_id = $user_id;
            $pengajuan->cuti_id = $user_id;
            $pengajuan->jenis_cuti = $req->jenis;
            $pengajuan->status = 1;
            $pengajuan->keterangan = $req->keterangan;

            if (kurangiCuti($user_id, $req->jenis, $lama_pengajuan)) {
                $pengajuan->save();
                return redirect()->route('index')->with('statusp', 'Pengajuan berhasil');
            } else {
                return redirect()->back()->with('message', 'Pengajuan melebihi saldo cuti');
            }

        } else {
            return redirect()->back()->with('message', 'Tanggal salah');
        }
    }



    public function update($id)
    {
        $pengajuan = Pengajuan::find($id);
        if ($pengajuan->status == 3) {
            return redirect()->route('riwayat')->with('status', 'Pengajuan sudah selesai!');
        }
        return view('pengajuan.edit', [
            'data_edit' => $pengajuan
        ]);
    }


    public function edit(Request $req)
    {
        $id = $req->id;
        $pengajuan = Pengajuan::find($id);
        $cuti = Cuti::find($id);
        $lama_pengajuan = 0;

        $tgl_mulai = strtotime($req->tgl_mulai);
        $tgl_mulai_date = date('Y-m-d', $tgl_mulai);

        if ($req->jenis == "Persalinan") {
            $lama_pengajuan = 1;
            $tgl_mulai1 = strtotime("+90 day", $tgl_mulai);
            $tgl_selesai_date = date('Y-m-d', $tgl_mulai1);
        } else {
            $tgl_selesai = strtotime($req->tgl_selesai);
            $tgl_selesai_date = date('Y-m-d', $tgl_selesai);
            $lama_pengajuan = date_diff(date_create($tgl_mulai_date), date_create($tgl_selesai_date))->days;
        }


        if ($tgl_mulai_date < $tgl_selesai_date) {

            tambahCuti(auth()->user()->id, $pengajuan->jenis_cuti, $pengajuan->lama_pengajuan);
            kurangiCuti(auth()->user()->id, $req->jenis, $lama_pengajuan);

            $pengajuan->keterangan = $req->keterangan;
            $pengajuan->lama_pengajuan = $lama_pengajuan;
            $pengajuan->jenis_cuti = $req->jenis;
            $pengajuan->tgl_mulai = $tgl_mulai_date;
            $pengajuan->tgl_selesai = $tgl_selesai_date;

            $pengajuan->save();


            return redirect()->route('riwayat')->with('status', 'Pengajuan berhasil diubah!');
        } else {
            return redirect()->back()->with('status', 'Tanggal salah!');
        }
    }


    public function accept(Request $req)
    {
        try {
            $pengajuan = Pengajuan::find($req->id);
            $pengajuan->status = $req->status;
            $pengajuan->tgl_persetujuan = now();
            $pengajuan->save();

            return redirect()->route('approver')->with('status', 'Pengajuan diterima!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Terjadi kesalahan!');
        }
    }

    public function reject(Request $req)
    {
        try {
            $pengajuan = Pengajuan::find($req->id);
            $cuti = Cuti::find($pengajuan->cuti_id);

            $pengajuan->status = $req->status;

            tambahCuti($pengajuan->user_id, $pengajuan->jenis_cuti, $pengajuan->lama_pengajuan);

            $pengajuan->save();

            return redirect()->route('approver')->with('status', 'Pengajuan ditolak!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Terjadi kesalahan!');
        }
    }
}
