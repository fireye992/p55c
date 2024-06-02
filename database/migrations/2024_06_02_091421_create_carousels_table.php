<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselsTable extends Migration
{
    public function up()
    {
        Schema::create('carousels', function (Blueprint $table) {
            $table->id();
            $table->string('media_path');
            $table->string('media_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carousels');
    }
}