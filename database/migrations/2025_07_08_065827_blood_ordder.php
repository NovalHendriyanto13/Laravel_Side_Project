<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->integer('rs_id');
            $table->string('kode_pemesanan');
            $table->string('tipe');
            $table->string('dokter');
            $table->date('tgl_pemesanan');
            $table->date('tgl_diperlukan');
            $table->string('diagnosis');
            $table->string('alasan_transfusi');
            $table->string('hb');
            $table->string('trombosit');
            $table->string('berat_badan')->nullable();
            $table->string('nama_pasien');
            $table->string('nama_pasangan')->nullable();
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('no_telp');
            $table->boolean('transfusi_sebelumnya')->default(0);
            $table->date('tgl_transfusi_sebelumnya')->nullable();
            $table->string('gejala_reaksi')->nullable();
            $table->string('tempat_serologi')->nullable();
            $table->date('tgl_serologi')->nullable();
            $table->string('hasil_serologi')->nullable();
            $table->boolean('hamil')->default(0);
            $table->integer('jumlah_kehamilan')->nullable();
            $table->boolean('pernah_aborsi')->default(0);
            $table->smallInteger('status');
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
