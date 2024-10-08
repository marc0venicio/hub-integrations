<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->datetime('started_at');
            $table->datetime('expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
