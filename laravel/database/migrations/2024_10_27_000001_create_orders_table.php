<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('date');
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
