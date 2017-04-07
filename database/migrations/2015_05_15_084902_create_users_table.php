<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre',50);
            $table->string('apellido',50);
            $table->string('email', 100);
            $table->string('departamento', 50);
            $table->string('rol', 50);
            $table->string('password', 200);
            $table->string('remember_token', 200);
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
      Schema::drop('usuarios');
   }

}
