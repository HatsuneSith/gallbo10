<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UsuariosTableSeeder');
	}

}

class UsuariosTableSeeder extends Seeder {

    public function run()
    {
        DB::table('usuarios')->insert(array(
                'nombre' => 'Miguel',
                'apellido' => 'Lara',
                'email' => 'mlara@markoptic.mx',
                'departamento' => 'Direccion',
                'rol' => 'Directivo',
                'password' => Hash::make('malo4410')
        ));

 
    }

}