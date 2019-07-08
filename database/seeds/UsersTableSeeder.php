<?php

use App\Entities\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'            =>  'Unassigned',
            'email'           =>  'CantDelete',
            'password'        =>  Hash::make(Str::random(10)),
            'remember_token'  =>  Str::random(10),
            'level'           =>  '1'
        ]);
        User::create([
            'name'            =>  'user1',
            'email'           =>  'user1@gmail.com',
            'password'        =>  Hash::make('user123'),
            'remember_token'  =>  Str::random(10),
            'level'           =>  '1'
        ]);
        User::create([
            'name'            =>  'user2',
            'email'           =>  'user2@gmail.com',
            'password'        =>  Hash::make('user123'),
            'remember_token'  =>  Str::random(10),
            'level'           =>  '1'
        ]);
        User::create([
            'name'            =>  'user3',
            'email'           =>  'user3@gmail.com',
            'password'        =>  Hash::make('user123'),
            'remember_token'  =>  Str::random(10),
            'level'           =>  '1'
        ]);
        User::create([
            'name'            =>  'user4',
            'email'           =>  'user4@gmail.com',
            'password'        =>  Hash::make('user123'),
            'remember_token'  =>  Str::random(10),
            'level'           =>  '1'
        ]);
        User::create([
            'name'            =>  'user5',
            'email'           =>  'user5@gmail.com',
            'password'        =>  Hash::make('user123'),
            'remember_token'  =>  Str::random(10),
            'level'           =>  '1'
        ]);
        User::create([
            'name'            =>  'user6',
            'email'           =>  'user6@gmail.com',
            'password'        =>  Hash::make('user123'),
            'remember_token'  =>  Str::random(10),
            'level'           =>  '1'
        ]);
        User::create([
            'name'            =>  'user7',
            'email'           =>  'user7@gmail.com',
            'password'        =>  Hash::make('user123'),
            'remember_token'  =>  Str::random(10),
            'level'           =>  '1'
        ]);
        User::create([
            'name'            =>  'user8',
            'email'           =>  'user8@gmail.com',
            'password'        =>  Hash::make('user123'),
            'remember_token'  =>  Str::random(10),
            'level'           =>  '1'
        ]);
        User::create([
            'name'            =>  'user9',
            'email'           =>  'user9@gmail.com',
            'password'        =>  Hash::make('user123'),
            'remember_token'  =>  Str::random(10),
            'level'           =>  '1'
        ]);
        User::create([
            'name'            =>  'user10',
            'email'           =>  'user10@gmail.com',
            'password'        =>  Hash::make('user123'),
            'remember_token'  =>  Str::random(10),
            'level'           =>  '1'
        ]);
        User::create([
            'name'            =>  'admin1',
            'email'           =>  'admin1@gmail.com',
            'password'        =>  Hash::make('admin123'),
            'remember_token'  =>  Str::random(10),
            'level'           =>  '2'
        ]);
        User::create([
            'name'            =>  'admin2',
            'email'           =>  'admin2@gmail.com',
            'password'        =>  Hash::make('admin123'),
            'remember_token'  =>  Str::random(10),
            'level'           =>  '2'
        ]);
        User::create([
            'name'            =>  'admin3',
            'email'           =>  'admin3@gmail.com',
            'password'        =>  Hash::make('admin123'),
            'remember_token'  =>  Str::random(10),
            'level'           =>  '2'
        ]);
    }
}
