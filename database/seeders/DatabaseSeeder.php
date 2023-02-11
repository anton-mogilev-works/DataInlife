<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Иванов',
            'email' => 'info@datainlife.ru'
        ]);

        DB::table('users')->insert([
            'name' => 'Петров',
            'email' => 'job@datainlife.ru'
        ]);

        DB::table('groups')->insert([
            'name' => 'Группа1',
            'expire_hours' => 1
        ]);


        DB::table('groups')->insert([
            'name' => 'Группа2',
            'expire_hours' => 2
        ]);

               
    }
}