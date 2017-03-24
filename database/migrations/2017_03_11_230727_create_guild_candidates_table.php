<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuildCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guild_candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('guild_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            //TODO: Relations
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guild_candidates');
    }
}
