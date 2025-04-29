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
        Schema::create('payment_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key for the user making the request
            $table->decimal('withdraw_amount', 10, 2); // Amount requested
            $table->string('bank_name');
            $table->string('branch');
            $table->string('account_name');
            $table->string('account_number');
            $table->decimal('processing_fee', 10, 2)->default(0.00); // Fee deducted from the amount
            $table->decimal('paid_amount', 10, 2)->default(0.00); // Amount after processing fee
            $table->string('status')->default('Pending'); // Request status (Pending/Approved/Rejected)
            $table->timestamp('requested_at')->useCurrent(); // Time of request
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_requests');
    }
};
