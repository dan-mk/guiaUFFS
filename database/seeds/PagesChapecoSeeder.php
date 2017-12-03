<?php

use App\Section;
use Illuminate\Database\Seeder;

class PagesChapecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$user_id = 1;
		$section_id = Section::where('subdomain', 'chapeco')->first()->id;

		$pages = [
			['address' => 'biblioteca', 'title' => 'Biblioteca'],
			['address' => 'cantina', 'title' => 'Cantina'],
			['address' => 'cursos', 'title' => 'Cursos'],
			['address' => 'food-trucks', 'title' => 'Food Trucks'],
			['address' => 'onibus', 'title' => 'Horários de Ônibus'],
			['address' => 'infraestrutura', 'title' => 'Infraestrutura'],
			['address' => 'ru', 'title' => 'Restaurante Universitário']
		];

		foreach($pages as $page){
			$page_id = DB::table('pages')->insertGetId([
				'address' => $page['address'],
				'user_id' => $user_id,
				'section_id' => $section_id
	        ]);

			DB::table('page_versions')->insert([
				'title' => $page['title'],
				'content' => '',
				'page_id' => $page_id,
				'user_id' => $user_id
	        ]);
		}
    }
}
