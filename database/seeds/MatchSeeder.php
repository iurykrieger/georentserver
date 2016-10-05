<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MatchSeeder extends Seeder
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
	        DB::table('match')->insert([
		            'idResidence' => rand(1,5),
		            'idUser' => rand(1,5),
		            'like' => rand(0,1),
		            'dateTime' => $date->format('Y-m-d H:i:s'),
		            'diamond' => rand(0,1),
		        ]);
	    }
    }
}
