<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i = 0; $i < 50; $i++){
	        DB::table('city')->insert([
	            'name' => str_random(20),
	            'uf' => str_random(2),
	        ]);
        }
    }
}
