<?php

use Illuminate\Database\Seeder;

class NursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_nurse = new \App\Nurse();
        $default_nurse->username = 'nurse';
        $default_nurse->password = bcrypt('nursepass');
        $default_nurse->name = 'default nurse';
        $default_nurse->save();
    }

}
