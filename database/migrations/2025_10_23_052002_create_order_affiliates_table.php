<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAffiliatesTable extends Migration
{
    public function up()
    {
        Schema::create('order_affiliates', function (Blueprint $table) {
            $table->id();
            $table->string('order_code'); // FK to customer_orders
            $table->string('tracking_id'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_affiliates');
    }
}
