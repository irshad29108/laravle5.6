<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TimezoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

         DB::table('timezone_masters')->insert([
			['type' => 'UTC+05:30 - Asia/Kolkata','status' =>'1']
    	]);
    }
}
