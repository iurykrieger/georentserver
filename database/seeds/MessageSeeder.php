<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
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
	        DB::table('message')->insert([
		            'idFrom' => rand(1,10),
					'idTo' => rand(1,10),
					'message' => str_random(200),
					'dateTime' => $date->format('Y-m-d H:i:s'),
					'resource' => rand(1,10),
					'path' => "C:'\'".str_random(200),
		        ]);
	    }
    }
}
