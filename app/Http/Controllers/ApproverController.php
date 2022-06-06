<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApproverController extends Controller
{
    public function index()
    {
        $status = 0;
        $jabatan = auth()->user()->jabatan;
        if ($jabatan == "Kepala Divisi") {
            $status = 1;
        } elseif ($jabatan == "HRD") {
            $status = 2;
        }
        $data = Pengajuan::where('status', '=', $status)->get();
        return view(
            'approver.index',
            [
                'data_pengajuan' => $data
            ]
        );
    }

    public function rejected()
    {
        return view(
            'approver.index',
            [
                'data_pengajuan' => Pengajuan::where('status', '=', 0)->get()
            ]
        );
    }

    public function approved()
    {
        return view(
            'approver.index',
            [
                'data_pengajuan' => Pengajuan::where('status', '=', 3)->get()
            ]
        );
    }
}
