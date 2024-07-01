<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConversationIdToMessajes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messajes', function (Blueprint $table) {
            //
            $table->foreignId('conversation_id')->constrained()->after('receiver_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messajes', function (Blueprint $table) {
            //
            $table->dropForeign('conversation_id');
            $table->dropColumn('conversation_id');
        });
    }
}