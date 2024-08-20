<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_number')->unique();
            $table->string('status');
            $table->decimal('total_amount', 15, 2);
            $table->string('external')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
