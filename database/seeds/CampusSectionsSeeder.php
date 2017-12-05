<?php

use Illuminate\Database\Seeder;

class CampusSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$campi = [
			['name' => 'Campus Cerro Largo', 'subdomain' => 'cerrolargo'],
			['name' => 'Campus Chapecó', 'subdomain' => 'chapeco'],
			['name' => 'Campus Erechim', 'subdomain' => 'erechim'],
			['name' => 'Campus Laranjeiras do Sul', 'subdomain' => 'laranjeirasdosul'],
			['name' => 'Campus Passo Fundo', 'subdomain' => 'passofundo'],
			['name' => 'Campus Realeza', 'subdomain' => 'realeza'],
		];

		foreach($campi as $campus){
			$section_id = DB::table('sections')->insertGetId([
				'name' => $campus['name'],
				'subdomain' => $campus['subdomain'],
				'user_id' => 1,
	        ]);

			DB::table('parentages')->insert([
				'parent' => 1,
				'child' => $section_id,
	        ]);
		}
    }
}
