<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('level')->unsigned()->default(1);
            $table->string('picture');
            $table->string('email')->unique();
            $table->integer('profession_id')->unsigned()->default(1);
            $table->integer('experience')->unsigned()->default(0);
            $table->integer('total_health')->unsigned()->default(150);
            $table->integer('current_health')->unsigned()->default(150);
            $table->integer('total_mana')->unsigned()->default(100);
            $table->integer('current_mana')->unsigned()->default(100);
            $table->integer('total_stamina')->unsigned()->default(100);
            $table->integer('current_stamina')->unsigned()->default(100);
            $table->integer('mastery_points')->unsigned()->default(0);
            $table->integer('strength')->unsigned()->default(1);
            $table->integer('dexterity')->unsigned()->default(1);
            $table->integer('constitution')->unsigned()->default(1);
            $table->integer('intelligence')->unsigned()->default(1);
            $table->integer('charisma')->unsigned()->default(1);
            $table->integer('dungeon_level')->unsigned()->default(1);
            $table->integer('sword_level')->unsigned()->default(1);
            $table->integer('secret_level')->unsigned()->default(1);
            $table->integer('luck_level')->unsigned()->default(1);
            $table->integer('learning_level')->unsigned()->default(1);
            $table->integer('thievery_level')->unsigned()->default(1);
            $table->integer('training_mastery')->unsigned()->nullable();
            $table->integer('gold')->unsigned()->default(100);
            $table->datetime('end_training')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
