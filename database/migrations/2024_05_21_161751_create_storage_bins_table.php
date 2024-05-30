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
        Schema::create('storage_bins', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bin');
            $table->string('nama_bin');
            $table->unsignedBigInteger('sloc_id');
            $table->timestamps();

            $table->foreign('sloc_id')->references('id')->on('storage_locations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storage_bins');
    }
};
