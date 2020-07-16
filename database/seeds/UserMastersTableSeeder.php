<?php

use Illuminate\Database\Seeder;

class UserMastersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('user_masters')->insert([
            'user_id' =>DB::table('users')->first()->id,
            'created_by' => 1,
            'role_id' => 1,
            'password' => 'secret',
            'name' => 'IAC',
            'user_name' => 'projects@genyventures.in',
        ]);


    }
}
