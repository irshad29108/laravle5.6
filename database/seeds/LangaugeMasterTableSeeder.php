<?php

use Illuminate\Database\Seeder;
use App\Models\LanguageMaster;

class LangaugeMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data = array('HI'=>'Hindi','EN'=>'English');
        foreach ($data as $key => $value) {
        	LanguageMaster::create([
	            'code' => $key,
	            'name' => $value,
	            'status' =>'1',
	        ]);
        }
    }
}
