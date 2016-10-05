<?php

use Illuminate\Database\Seeder;

class UserImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++){
	        DB::table('userImage')->insert([
		            'idUser' => rand(1,5),
		            'path' => "C:'\'".str_random(50),
					'resource' => rand(1,10),
					'order' => rand(1,10),
		        ]);
	    }
    }
}
