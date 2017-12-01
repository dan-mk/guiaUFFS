<?php

use Illuminate\Database\Seeder;

class MainSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('sections')->insert([
            'name' => 'Universidade Federal da Fronteira Sul',
            'subdomain' => '',
            'user_id' => 1,
        ]);
    }
}
