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
    if (!Schema::hasTable('raffle_tickets')) {
        Schema::create('raffle_tickets', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key for user
            $table->string('token')->unique(); // Unique token for the ticket
            $table->enum('status', ['Pending', 'Active', 'Used', 'Expired']); // Status of the ticket
            $table->timestamps(); // Laravel's created_at and updated_at fields

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('affiliate_users')->onDelete('cascade');
        });
    }
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raffle_tickets');
    }
};
