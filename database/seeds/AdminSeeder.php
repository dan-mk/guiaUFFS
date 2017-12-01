<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@guia.uffs',
            'password' => bcrypt('admin'),
			'admin' => true
        ]);
    }
}
