<?php

use Illuminate\Database\Seeder;

class BranchMastersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


         DB::table('branch_masters')->insert([
            'company_id' =>DB::table('user_masters')->first()->id,
            'branch_name' => 'GenYventure',
            'city_id' => 706,
            'zipcode' => '11001',
            'email_id'=>'projects@genyventures.in'
        ]);

    }
}
