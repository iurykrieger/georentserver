<?php

use Illuminate\Database\Seeder;

class ResidenceImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++){
	        DB::table('residenceImage')->insert([
		            'idResidence' => rand(1,10),
		            'path' => "C:'\'".str_random(50),
					'resource' => rand(1,10),
					'order' => rand(1,10),
		        ]);
	    }
    }
}
