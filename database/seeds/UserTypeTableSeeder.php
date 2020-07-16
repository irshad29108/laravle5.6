<?php
use Illuminate\Database\Seeder;
use App\Models\Role;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array('Super Admin','Admin','Re seller','Company','Branch','User');

        foreach ($data as $key => $value) {
        	Role::create([
                'name' => $value,
	            'guard_name' => str_replace(" ",'', strtolower($value)),
	            'status' =>'1',
	        ]);
        }
    }
}
