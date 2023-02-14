<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections_teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teachers_id');
            $table->foreign('teachers_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->unsignedBigInteger('sections_id');
            $table->foreign('sections_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections_teachers');
    }
}
