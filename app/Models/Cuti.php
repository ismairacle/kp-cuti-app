<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'tbl_cuti';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'user_id', 'persalinan', 'pernikahan', 'tahunan'];

    public function cutiPengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }

}
