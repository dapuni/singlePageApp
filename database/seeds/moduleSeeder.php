<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class moduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            'module' => 'Settings',
            'parent' => 0,
            'link' => 'Settings',
            'ordered' => 0,
        ]);

        DB::table('modules')->insert([
            'module' => 'User',
            'parent' => 1,
            'link' => 'users',
            'ordered' => 1,
        ]);

        DB::table('modules')->insert([
            'module' => 'Role',
            'parent' => 1,
            'link' => 'roles',
            'ordered' => 2,
        ]);

        DB::table('modules')->insert([
            'module' => 'Module',
            'parent' => 1,
            'link' => 'modules',
            'ordered' => 3,
        ]);
    }
}
