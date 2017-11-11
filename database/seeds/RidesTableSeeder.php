<?php

use Illuminate\Database\Seeder;

class RidesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/import/rides.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Rides table seeded!');
    }
}
