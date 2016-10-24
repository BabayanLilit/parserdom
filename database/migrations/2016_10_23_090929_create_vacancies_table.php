<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->bigInteger('external_id')->unique();
            $table->bigInteger('employer_id')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('salary')->nullable();
            $table->text('responsibility')->nullable();
            $table->text('requirement')->nullable();
            $table->string('city')->nullable();
            $table->date('date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancies');
    }
}
