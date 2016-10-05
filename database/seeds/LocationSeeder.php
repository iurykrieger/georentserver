<?php

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++){
	        DB::table('location')->insert([
	            'latitude' => rand(0, 10) / 10,
	            'longitude' => rand(0, 10) / 10,
	            'idCity' => rand(1,10),
	        ]);
        }
    }
}
