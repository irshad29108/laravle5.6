<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('countries')->delete();
        $countries = Config::get('countries');
        if ($countries) {
           DB::table('countries')->insert($countries);
        }
    }
}
