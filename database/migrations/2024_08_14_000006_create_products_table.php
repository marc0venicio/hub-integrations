<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->decimal('price', 15, 2);
            $table->integer('stok')->nullable();
            $table->string('sku')->unique();
            $table->string('external')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
