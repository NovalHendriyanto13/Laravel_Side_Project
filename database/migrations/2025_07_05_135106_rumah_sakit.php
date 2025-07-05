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
        Schema::create('rumah_sakit', function (Blueprint $table) {
            $table->id();
            $table->string('kode_rs');
            $table->string('nama_rs');
            $table->string('email');
            $table->string('no_telp');
            $table->string('penanggung_jawab_rs');
            $table->string('kota');
            $table->string('kode_pos');
            $table->string('alamat');
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
