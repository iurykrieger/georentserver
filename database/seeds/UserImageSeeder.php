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
        for ($i = 1; $i <= 50; $i++){
	        DB::table('userImage')->insert([
                    'idUser' => $i,
		            'path' => "C:'\'".str_random(50),
					'resource' => rand(1,10),
					'orderImage' => rand(1,10),
		        ]);
	    }
        for ($i = 1; $i <= 50; $i++){
            DB::table('userImage')->insert([
                    'idUser' => $i,
                    'path' => "C:'\'".str_random(50),
                    'resource' => rand(1,10),
                    'orderImage' => rand(1,10),
                ]);
        }
        for ($i = 1; $i <= 50; $i++){
            DB::table('userImage')->insert([
                    'idUser' => $i,
                    'path' => "C:'\'".str_random(50),
                    'resource' => rand(1,10),
                    'orderImage' => rand(1,10),
                ]);
        }
    }
}
