<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // Columna 'id' como clave primaria y autoincremental
            $table->string('Name'); // Columna 'Name' como VARCHAR
            $table->integer('Asistentes'); // Columna 'Asistentes' como INTEGER
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
