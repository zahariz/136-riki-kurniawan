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
        Schema::create('warehouse_management', function (Blueprint $table) {
            $table->id();
            $table->timestamp('exp_date')->nullable(true);
            $table->timestamp('prod_date')->nullable(true);
            $table->integer('qty');
            $table->string('batch');
            $table->timestamps();
            $table->unsignedBigInteger('sbin_id');
            $table->unsignedBigInteger('sloc_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('sbin_id')->references('id')->on('storage_bins');
            $table->foreign('sloc_id')->references('id')->on('storage_locations');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_management');
    }
};
