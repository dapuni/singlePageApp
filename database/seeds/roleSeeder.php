<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('roles')->insert([
            'role' => 'administrator',
            'module' => '1,2,3,4',
        ]);
    }
}
