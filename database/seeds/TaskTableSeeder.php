<?php

use Illuminate\Database\Seeder;
use App\Entities\Tasks;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tasks::create([
            'name'               =>     'show',
            'todo_list_id'       =>     '1',
            'user_id'            =>     '2',
            'status_id'          =>     '3',
            'position'           =>     '1'
        ]);
        Tasks::create([
            'name'               =>     'create',
            'todo_list_id'       =>     '1',
            'user_id'            =>     '3',
            'status_id'          =>     '2',
            'position'           =>     '1'
        ]);
        Tasks::create([
            'name'               =>     'edit',
            'todo_list_id'       =>     '1',
            'user_id'            =>     '8',
            'status_id'          =>     '1',
            'position'           =>     '1'
        ]);
        Tasks::create([
            'name'               =>     'delete',
            'todo_list_id'       =>     '1',
            'user_id'            =>     '2',
            'status_id'          =>     '1',
            'position'           =>     '2'
        ]);
        Tasks::create([
            'name'               =>     'search',
            'todo_list_id'       =>     '1',
            'user_id'            =>     '10',
            'status_id'          =>     '1',
            'position'           =>     '3'
        ]);
        Tasks::create([
            'name'               =>     'learn english',
            'todo_list_id'       =>     '2',
            'user_id'            =>     '3',
            'status_id'          =>     '1',
            'position'           =>     '1'
        ]);
        Tasks::create([
            'name'               =>     'do math',
            'todo_list_id'       =>     '2',
            'user_id'            =>     '3',
            'status_id'          =>     '3',
            'position'           =>     '1'
        ]);
        Tasks::create([
            'name'               =>     'practice drawing',
            'todo_list_id'       =>     '2',
            'user_id'            =>     '3',
            'status_id'          =>     '2',
            'position'           =>     '1'
        ]);
        Tasks::create([
            'name'               =>     'fix exercises errors',
            'todo_list_id'       =>     '2',
            'user_id'            =>     '6',
            'status_id'          =>     '1',
            'position'           =>     '2'
        ]);
        Tasks::create([
            'name'               =>     'memorize vocabulary',
            'todo_list_id'       =>     '3',
            'user_id'            =>     '4',
            'status_id'          =>     '3',
            'position'           =>     '1'
        ]);
        Tasks::create([
            'name'               =>     'practice listening',
            'todo_list_id'       =>     '3',
            'user_id'            =>     '4',
            'status_id'          =>     '1',
            'position'           =>     '1'
        ]);
        Tasks::create([
            'name'               =>     'practice speaking with everyone',
            'todo_list_id'       =>     '3',
            'user_id'            =>     '7',
            'status_id'          =>     '2',
            'position'           =>     '1'
        ]);
        Tasks::create([
            'name'               =>     'complete a short article',
            'todo_list_id'       =>     '3',
            'user_id'            =>     '8',
            'status_id'          =>     '1',
            'position'           =>     '2'
        ]);
        Tasks::create([
            'name'               =>     'think ideas',
            'todo_list_id'       =>     '4',
            'user_id'            =>     '5',
            'status_id'          =>     '3',
            'position'           =>     '1'
        ]);
        Tasks::create([
            'name'               =>     'collect informations',
            'todo_list_id'       =>     '4',
            'user_id'            =>     '6',
            'status_id'          =>     '1',
            'position'           =>     '2'
        ]);
        Tasks::create([
            'name'               =>     'deploy the work',
            'todo_list_id'       =>     '4',
            'user_id'            =>     '3',
            'status_id'          =>     '2',
            'position'           =>     '1'
        ]);
        Tasks::create([
            'name'               =>     'general model',
            'todo_list_id'       =>     '4',
            'user_id'            =>     '3',
            'status_id'          =>     '1',
            'position'           =>     '1'
        ]);
        Tasks::create([
            'name'               =>     'detailed model',
            'todo_list_id'       =>     '4',
            'user_id'            =>     '3',
            'status_id'          =>     '1',
            'position'           =>     '3'
        ]);
    }
}
