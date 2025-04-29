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
        Schema::create('affiliate_users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('address', 255)->nullable();
            $table->string('district', 255)->nullable();
            $table->date('DOB');
            $table->string('gender', 50)->nullable();
            $table->string('NIC', 20);
            $table->string('contactno', 20);
            $table->string('email', 255)->unique();
            $table->string('password', 255);  
            $table->json('promotion_method')->nullable(); 
            $table->string('instagram_url', 255)->nullable();
            $table->string('facebook_url', 255)->nullable();
            $table->string('tiktok_url', 255)->nullable();
            $table->string('youtube_url', 255)->nullable();
            $table->string('content_website_url', 255)->nullable();
            $table->string('content_whatsapp_url', 255)->nullable();
            $table->string('bank_name', 255)->nullable();
            $table->string('branch', 255)->nullable();
            $table->string('account_name', 255)->nullable();
            $table->string('account_number', 255)->nullable();
            $table->string('status', 50)->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_users');
    }
};
