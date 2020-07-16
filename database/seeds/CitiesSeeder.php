<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    public function run()
    {
        DB::table('cities')->delete();
        $cities = Config::get('cities');
        if ($cities) {
            DB::table('cities')->insert($cities);
        }
       
    }
}
