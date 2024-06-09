<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHtmlContentToSearchModels extends Migration
{
    public function up()
    {
        Schema::table('search_models', function (Blueprint $table) {
            $table->text('html_content')->nullable();
        });
    }

    public function down()
    {
        Schema::table('search_models', function (Blueprint $table) {
            $table->dropColumn('html_content');
        });
    }
}