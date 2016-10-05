<?php

use Illuminate\Database\Seeder;

class ResidenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++){
	        DB::table('residence')->insert([
		            'idLocation' => rand(1,10),
					'idUser' => rand(1,10),
					'idPreference' => rand(1,10),
					'title' => str_random(100),
					'description' => str_random(200),
					'address' => str_random(200),
					'observation' => str_random(200),
					'rent' => rand(0, 10) / 10,
		        ]);
	    }
    }
}
