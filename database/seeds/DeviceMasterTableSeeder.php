<?php

use Illuminate\Database\Seeder;
use App\Models\DeviceMaster;

class DeviceMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = array('IAC140');
        foreach ($data as $key => $value) {
        	DeviceMaster::create([
	            'name' => $value,
	            'status' =>'1',
	        ]);
        }

    }
}
