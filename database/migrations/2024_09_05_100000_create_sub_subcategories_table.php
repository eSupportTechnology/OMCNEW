<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_subcategories', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('subcategory_id'); 
            $table->string('sub_subcategory')->nullable(); 
            $table->timestamps();  
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_subcategories');
    }
};
