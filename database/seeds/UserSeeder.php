<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i = 0; $i < 50; $i++){
	    	$date = Carbon::create(2015, 5, 28, 0, 0, 0);
	        DB::table('user')->insert([
		            'name' => str_random(20),
		            'birthDate' => $date->format('Y-m-d H:i:s'),
					'email' => str_random(20)."@gmail.com",
					'phone' => str_random(10),
					'password' => str_random(18),
					'credits' => rand(0, 10) / 10,
					'type' => rand(1,5),
					'distance' => rand(1,5),
					'idPreference' => rand(1,5),
					'idCity' => rand(1,5),
		        ]);
	    }
    }
}
