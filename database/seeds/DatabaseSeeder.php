<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CitySeeder::class);
         $this->call(LocationSeeder::class);
         $this->call(PreferenceSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(UserImageSeeder::class);
         $this->call(MessageSeeder::class);
         $this->call(ResidenceSeeder::class);
         $this->call(ResidenceImageSeeder::class);
         $this->call(MatchSeeder::class);
    }
}
