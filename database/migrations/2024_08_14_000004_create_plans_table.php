<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('description');
            $table->decimal('price', 15, 2);
            $table->string('billing_cycle');
            $table->string('feature');
            $table->integer('trial_period_days')->nullable();
            $table->string('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
