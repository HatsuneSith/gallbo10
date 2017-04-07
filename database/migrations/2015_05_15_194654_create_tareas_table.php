<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tareas', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('objetivo', 500);
            $table->text('compromiso');
            $table->dateTime('fecha');
            $table->string('estado', 50);
            $table->string('indicador', 50);
            $table->integer('id_responsable');
            $table->string('nombre_responsable', 50);
            $table->integer('id_asignador');
            $table->string('nombre_asignador', 50);
            $table->dateTime('fecha_concluida');
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
		Schema::drop('tareas');
	}

}
