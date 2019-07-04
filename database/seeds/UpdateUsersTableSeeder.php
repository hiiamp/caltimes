<?php

use App\Entities\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UpdateUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('email', 'user1@gmail.com')->update([
            'name'            =>  'Tran Van A'
        ]);
        User::where('email', 'user2@gmail.com')->update([
            'name'            =>  'Van Tran A'
        ]);
        User::where('email', 'user3@gmail.com')->update([
            'name'            =>  'Tran San B'
        ]);
        User::where('email', 'user4@gmail.com')->update([
            'name'            =>  'Van Ngoc H'
        ]);
        User::where('email', 'user5@gmail.com')->update([
            'name'            =>  'A B C'
        ]);
        User::where('email', 'user6@gmail.com')->update([
            'name'            =>  'Van K'
        ]);
        User::where('email', 'user7@gmail.com')->update([
            'name'            =>  'P Khanh'
        ]);
        User::where('email', 'user8@gmail.com')->update([
            'name'            =>  'Van A'
        ]);
        User::where('email', 'user9@gmail.com')->update([
            'name'            =>  'Tran C'
        ]);
        User::where('email', 'user10@gmail.com')->update([
            'name'            =>  'Le Thi Ly'
        ]);
        User::where('email', 'admin1@gmail.com')->update([
            'name'            =>  'Quan Ly A'
        ]);
        User::where('email', 'admin2@gmail.com')->update([
            'name'            =>  'Quan Ly B'
        ]);
        User::where('email', 'admin3@gmail.com')->update([
            'name'            =>  'Quan Ly C'
        ]);
    }
}
