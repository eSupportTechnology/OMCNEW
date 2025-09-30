<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('return_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->foreignId('order_id')->constrained('customer_order')->onDelete('cascade');

            $table->string('billing_last_name');
            $table->string('email');
            $table->text('reason')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->unique(['user_id', 'order_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('return_requests');
    }
}
