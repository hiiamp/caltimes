<?php

use Illuminate\Database\Seeder;
use App\Entities\TodoList;

class TodoListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TodoList::create([
            'name'       =>     'basic project',
            'link'       =>     str_random(8),
            'owner_id'   =>      '1',
            'is_public'  =>      '1'
        ]);
        TodoList::create([
            'name'       =>     'homewwork',
            'link'       =>     str_random(8),
            'owner_id'   =>      '2',
            'is_public'  =>      '1'
        ]);
        TodoList::create([
            'name'       =>     'learn english',
            'link'       =>     str_random(8),
            'owner_id'   =>      '3',
            'is_public'  =>      '0'
        ]);
        TodoList::create([
            'name'       =>     'create a news',
            'link'       =>     str_random(8),
            'owner_id'   =>      '4',
            'is_public'  =>      '1'
        ]);
    }
}
