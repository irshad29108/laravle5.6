<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MapMaster;

class MapTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = array('Bingo','Google','Hero','UFFZIO');

        foreach ($data as $key => $value) {
            MapMaster::create([
                'type' => $value,
                'status' =>'1',
            ]);
        }

    }
}
