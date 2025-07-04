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
        Schema::create('blood_stock', function (Blueprint $table) {
            $table->id();
            $table->integer('blood_id');
            $table->string('stock_no');
            $table->date('expiry_date');
            $table->string('blood_group');
            $table->string('blood_rhesus');
            $table->integer('unit_volume');
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
