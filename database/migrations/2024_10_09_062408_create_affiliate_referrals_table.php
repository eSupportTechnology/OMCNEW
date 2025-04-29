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
        if (!Schema::hasTable('affiliate_referrals')) {
            Schema::create('affiliate_referrals', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('raffle_ticket_id');
                $table->foreign('raffle_ticket_id')->references('id')->on('raffle_tickets')->onDelete('cascade');
                $table->string('product_url');
                $table->integer('views_count')->default(0);
                $table->integer('referral_count')->default(0);
                $table->decimal('product_price', 10, 2)->default(0);
                $table->decimal('affiliate_commission', 10, 2)->default(0);
                $table->timestamps();
            });
        }
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_referrals');
    }
};
