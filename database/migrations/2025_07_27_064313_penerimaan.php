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
        Schema::create('penerimaan', function (Blueprint $table) {
            $table->id();
            $table->integer('pemesanan_id');
            $table->string('kode_penerimaan');
            $table->date('tgl_penerimaan');
            $table->date('tgl_ambil_sampel')->nullable();
            $table->string('jam_ambil_sampel')->nullable();
            $table->integer('ambil_sample_oleh')->nullable();
            $table->date('tgl_terima_sampel')->nullable();
            $table->string('jam_terima_sampel')->nullable();
            $table->integer('terima_sample_oleh')->nullable();
            $table->date('tgl_periksa_sampel')->nullable();
            $table->string('jam_periksa_sampel')->nullable();
            $table->integer('periksa_sample_oleh')->nullable();
            $table->smallInteger('hasil_pemeriksaan')->nullable();
            $table->string('hasil_golongan_sampel')->nullable();
            $table->string('hasil_rhesus_sampel')->nullable();
            $table->integer('status');
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
