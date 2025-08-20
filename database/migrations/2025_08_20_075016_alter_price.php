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
        Schema::table('penerimaan_detail', function (Blueprint $table) {
            $table->integer('harga')->nullable()->after('sisa');
        });

        Schema::table('penerimaan', function (Blueprint $table) {
            $table->integer('total_harga')->nullable()->after('status');
        });

        Schema::table('blood_stock', function (Blueprint $table) {
            $table->integer('harga')->nullable()->after('status');
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
