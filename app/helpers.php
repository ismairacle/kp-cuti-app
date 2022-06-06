<?php


use App\Models\Cuti;

function kurangiCuti($user_id, $jenis, $lama)
{
    $user_cuti = Cuti::where('user_id', $user_id)->get();
    $sisa_cuti = 0;

    if ($jenis == "Pernikahan") {
        $sisa_cuti = $user_cuti[0]->pernikahan;
        $user_cuti[0]->pernikahan = $sisa_cuti - $lama;
    } elseif ($jenis == "Tahunan") {
        $sisa_cuti = $user_cuti[0]->tahunan;
        $user_cuti[0]->tahunan = $sisa_cuti - $lama;
    } elseif ($jenis == "Persalinan") {
        $sisa_cuti = $user_cuti[0]->persalinan;
        $user_cuti[0]->persalinan = $sisa_cuti - $lama;
    }

    if ($lama <= $sisa_cuti) {
        $sisa_cuti = $sisa_cuti - $lama;
        $user_cuti[0]->save();
        return true;
    } else {
        return false;
    }
}

function tambahCuti($user_id, $jenis, $lama)
{
    $user_cuti = Cuti::where('user_id', $user_id)->get();
    $sisa_cuti = 0;

    try {
        if ($jenis == "Pernikahan") {
            $sisa_cuti = $user_cuti[0]->pernikahan;
            $user_cuti[0]->pernikahan = $sisa_cuti + $lama;
        } elseif ($jenis == "Tahunan") {
            $sisa_cuti = $user_cuti[0]->tahunan;
            $user_cuti[0]->tahunan = $sisa_cuti + $lama;
        } elseif ($jenis == "Persalinan") {
            $sisa_cuti = $user_cuti[0]->persalinan;
            $user_cuti[0]->persalinan = $sisa_cuti + $lama;
        }
        $user_cuti[0]->save();
        return true;
    } catch (\Throwable $th) {
        return false;
    }
    
}


function createCuti($user_id, $jenis_kelamin)
{

    $persalinan = 0;
    if ($jenis_kelamin == "Perempuan") {
        $persalinan = 1;
    }

    Cuti::create([
        'id' => $user_id,
        'user_id' => $user_id,
        'persalinan' => $persalinan,
        'pernikahan' => 7,
        'tahunan' => 12,
    ]);
}
