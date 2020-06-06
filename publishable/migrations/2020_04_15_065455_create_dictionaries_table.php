<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictionaries', function (Blueprint $table) {
            $table->id();
            $table->string('from_id');
            $table->foreign('from_id')
                ->references('id')
                ->on('languages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('to_id');
            $table->foreign('to_id')
                ->references('id')
                ->on('languages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->longText('from');
            $table->longText('to')
                ->nullable();
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
        Schema::dropIfExists('dictionaries');
    }
}
