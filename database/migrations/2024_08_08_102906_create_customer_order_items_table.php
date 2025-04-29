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
        Schema::create('customer_order_items', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('order_code')->index();
            $table->string('product_id');
            $table->integer('quantity')->default(1);
            $table->string('size')->nullable();;
            $table->string('color')->nullable();;
            $table->date('date');
            $table->decimal('cost', 15, 2);
            $table->enum('reviewed', ['yes', 'no'])->default('no')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_order_items');
    }
};
