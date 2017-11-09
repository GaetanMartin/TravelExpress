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
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'first_name' => "Gaëtan",
            'last_name' => "MARTIN",
            'email' => 'test1@mail.com',
            'password' => bcrypt('123456'),
        ]);

        $id = DB::getPdo()->lastInsertId();


        DB::table('preferences')->insert([
        	'user_id' => $id,
        	'smoker_accepted' => 1,
        	'pet_accepted' => 1,
        ]); 

        DB::table('cars')->insert([
            'user_id' => $id,
            'model' => "Zafira",
            'make' => "Opel",
            'nb_seats' => 7,
        ]);       

        DB::table('users')->insert([
            'first_name' => "Adrien",
            'last_name' => "ROMANET",
            'email' => 'test2@mail.com',
            'password' => bcrypt('123456'),
        ]);

        $id = DB::getPdo()->lastInsertId();

        DB::table('preferences')->insert([
        	'user_id' => $id,
        	'chat_accepted' => 1,
        	'radio_accepted' => 1,
        ]);

        DB::table('cars')->insert([
            'user_id' => $id,
            'model' => "Aveo",
            'make' => "Chevrolet",
            'nb_seats' => 5,
        ]);
    }
}
