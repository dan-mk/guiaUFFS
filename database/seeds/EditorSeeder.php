<?php

use App\Section;
use Illuminate\Database\Seeder;

class EditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$section_id = Section::where('subdomain', 'chapeco')->first()->id;

		$user_id = DB::table('users')->insertGetId([
            'name' => 'editor',
            'email' => 'editor@guia.uffs',
            'password' => bcrypt('editor'),
        ]);

		DB::table('permissions')->insert([
			'user_id' => $user_id,
			'section_id' => $section_id
		]);
    }
}
