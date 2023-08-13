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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name'); 
            $table->bigInteger('category_id',false, true); 
            $table->bigInteger('unit_id',false, true);
            $table->bigInteger('brand_id', false, true);
            $table->integer('stock_in_hand')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->dropSoftDeletes();
        Schema::dropIfExists('items');
    }
};
