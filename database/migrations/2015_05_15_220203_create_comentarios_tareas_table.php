<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosTareasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comentarios_tareas', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('id_tarea');
            $table->text('comentario');
            $table->integer('id_usuario');
            $table->integer('nombre_usuario');
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
		Schema::drop('comentarios_tareas');
	}

}
