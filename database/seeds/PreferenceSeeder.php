<?php

use Illuminate\Database\Seeder;

class PreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++){
	        DB::table('preference')->insert([
	            'sponsor' => rand(1, 5),
	            'room' => rand(1,5),
				'bathroom' => rand(1,5),
				'vacancy' => rand(1,5),
				'laundry' => rand(1,5),
				'income' => rand(0, 10) / 10,
				'condominium' => rand(1,5),
				'child' => rand(1,5),
				'stay' => rand(1,5),
				'pet' => rand(1,5),
	        ]);
        }
    }
}
