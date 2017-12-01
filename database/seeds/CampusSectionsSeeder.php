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
			['name' => 'Cerro Largo', 'subdomain' => 'cerrolargo'],
			['name' => 'Chapecó', 'subdomain' => 'chapeco'],
			['name' => 'Erechim', 'subdomain' => 'erechim'],
			['name' => 'Laranjeiras do Sul', 'subdomain' => 'laranjeirasdosul'],
			['name' => 'Passo Fundo', 'subdomain' => 'passofundo'],
			['name' => 'Realeza', 'subdomain' => 'realeza'],
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
