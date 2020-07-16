<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
  /**
  * Seed the application's database.
  *
  * @return void
  */
  public function run()
  {
    $this->call(CitiesSeeder::class);
    $this->call(CountriesSeeder::class);
    $this->call(UserSeeder::class);
    $this->call(UserTypeTableSeeder::class);
    $this->call(TimezoneTableSeeder::class);
    $this->call(MapTableSeeder::class);
    $this->call(PoiTypeSeeder::class);
    $this->call(AlertTypeTableSeeder::class);
    $this->call(LangaugeMasterTableSeeder::class);
    //$this->call(DeviceMasterTableSeeder::class);
    $this->call(UserMastersTableSeeder::class);
    // $this->call(BranchMastersTableSeeder::class);

    $this->call(RoleAndPermissionSeeder::class);
  }

  
}
