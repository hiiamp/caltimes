<?php

use Illuminate\Database\Seeder;
use App\Entities\Access;

class AccessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Access::create([
           'user_id'        => '2',
           'todo_list_id'   => '1'
        ]);
        Access::create([
            'user_id'        => '4',
            'todo_list_id'   => '1'
        ]);
        Access::create([
            'user_id'        => '8',
            'todo_list_id'   => '1'
        ]);
        Access::create([
            'user_id'        => '10',
            'todo_list_id'   => '1'
        ]);
        Access::create([
            'user_id'        => '3',
            'todo_list_id'   => '2'
        ]);
        Access::create([
            'user_id'        => '6',
            'todo_list_id'   => '2'
        ]);
        Access::create([
            'user_id'        => '9',
            'todo_list_id'   => '2'
        ]);
        Access::create([
            'user_id'        => '11',
            'todo_list_id'   => '2'
        ]);
        Access::create([
            'user_id'        => '4',
            'todo_list_id'   => '3'
        ]);
        Access::create([
            'user_id'        => '7',
            'todo_list_id'   => '3'
        ]);
        Access::create([
            'user_id'        => '8',
            'todo_list_id'   => '3'
        ]);
        Access::create([
            'user_id'        => '5',
            'todo_list_id'   => '3'
        ]);
        Access::create([
            'user_id'        => '5',
            'todo_list_id'   => '4'
        ]);
        Access::create([
            'user_id'        => '2',
            'todo_list_id'   => '4'
        ]);
        Access::create([
            'user_id'        => '3',
            'todo_list_id'   => '4'
        ]);
        Access::create([
            'user_id'        => '6',
            'todo_list_id'   => '4'
        ]);
    }
}
