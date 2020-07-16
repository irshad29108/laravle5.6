<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoiTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


         DB::table('poi_type_masters')->insert([
			['name' => 'Airport'],
			['name' => 'ATM'],
			['name' => 'Bank'],
			['name' => 'Beach'],
    	]);

    }
}
