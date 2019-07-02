<?php

use Illuminate\Database\Seeder;
use App\Entities\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name'    => 'To do'
        ]);
        Status::create([
            'name'    => 'In process'
        ]);
        Status::create([
            'name'    => 'Done'
        ]);
    }
}
