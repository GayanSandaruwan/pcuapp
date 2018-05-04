<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $default_admin = new \App\Admin();
        $default_admin->username = 'admindefault';
        $default_admin->password = bcrypt('adminpass');
        $default_admin->name = 'default administrator';
        $default_admin->save();
    }
}