<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
			AdminSeeder::class,
			EditorSeeder::class,
			MainSectionSeeder::class,
			CampusSectionsSeeder::class,
			PagesChapecoSeeder::class
		]);
    }
}
