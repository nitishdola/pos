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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('purchase_id', false, true);
            $table->bigInteger('item_id', false, true);
            $table->bigInteger('hsn_master_id', false, true);
            $table->float('quantity');
            $table->date('expiry_date')->nullable();
            $table->date('manufacturing_date')->nullable();
            $table->float('gst');
            $table->float('unit_cost');
            $table->float('mrp');
            $table->timestamps();

            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('hsn_master_id')->references('id')->on('hsn_masters')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
