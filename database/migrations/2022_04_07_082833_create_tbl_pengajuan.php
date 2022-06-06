<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPengajuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cuti', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('persalinan');
            $table->integer('pernikahan');
            $table->integer('tahunan');
            $table->timestamps();
        });

        Schema::create('tbl_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('cuti_id')->unsigned();
            $table->foreign('cuti_id')->references('id')->on('tbl_cuti')->onDelete('cascade');
            $table->string('kode_pengajuan');
            $table->string('jenis_cuti');
            $table->integer('status');
            $table->date('tgl_pengajuan');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->date('tgl_persetujuan')->nullable();
            $table->integer('lama_pengajuan');
            $table->string('keterangan');
            $table->timestamps();

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pengajuan');
        Schema::dropIfExists('tbl_cuti');
    }
}



 