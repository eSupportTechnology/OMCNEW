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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->unique();
            $table->string('product_name');
            $table->text('product_description')->nullable();
            $table->string('product_category')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('subcategory')->nullable();
            $table->string('sub_subcategory')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('tags')->nullable();
            $table->decimal('normal_price', 8, 2);
            $table->boolean('is_affiliate')->default(false);
            $table->decimal('affiliate_price', 8, 2)->nullable();
            $table->decimal('commission_percentage', 5, 2)->nullable();
            $table->decimal('total_price', 8, 2);
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
