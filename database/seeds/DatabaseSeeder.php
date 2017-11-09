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

        $this->call(UsersTableSeeder::class);

        $path = 'database/import/cities.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Cities table seeded!');
    }
}
