<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveJobIdFromConversationsTable extends Migration
{
    public function up()
    {
        Schema::table('conversations', function (Blueprint $table) {
            if (Schema::hasColumn('conversations', 'job_id')) {
                $table->dropColumn('job_id');
            }
        });
    }

    public function down()
    {
        Schema::table('conversations', function (Blueprint $table) {
            if (!Schema::hasColumn('conversations', 'job_id')) {
                $table->unsignedBigInteger('job_id')->nullable();
            }
        });
    }
}