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
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sales_id', false, true);
            $table->bigInteger('item_id', false, true);
            $table->bigInteger('purchase_item_id', false, true);
            $table->decimal('purchase_price', 10, 2);
            $table->decimal('sell_price', 10, 2);
            $table->decimal('gst', 10, 2);
            $table->decimal('quantity', 10, 2);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('sales_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('purchase_item_id')->references('id')->on('purchase_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};
