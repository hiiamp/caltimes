<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Eloquent::unguard();
        //$this->call(UsersTableSeeder::class);
        //$this->call(TodoListTableSeeder::class);
        //$this->call(StatusTableSeeder::class);
        //$this->call(TaskTableSeeder::class);
        //$this->call(AccessTableSeeder::class);
        $this->call(UpdateUsersTableSeeder::class);
    }
}
