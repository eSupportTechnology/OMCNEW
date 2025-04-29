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
        Schema::table('aff_customers', function (Blueprint $table) {
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aff_customers', function (Blueprint $table) {
            $table->dropColumn([
                'promotion_method',
                'instagram_url',
                'facebook_url',
                'tiktok_url',
                'youtube_url',
                'content_website_url',
                'content_whatsapp_url',
                'bank_name',
                'branch',
                'account_name',
                'account_number',
            ]);
        });
    }
};
