<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTermIdToParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->integer('term_id')->unsigned()->nullable();

            $table->foreign('term_id')->references('id')->on('terms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropForeign(['term_id']);
        });
    }
}
