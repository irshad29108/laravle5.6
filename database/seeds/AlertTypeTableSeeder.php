<?php

use Illuminate\Database\Seeder;
use App\Models\AlertTypeMaster;

class AlertTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data = array(
                'Power'=>1,
                'SOS/PanicButton'=>2,
                'Ignition'=>3,
                'OverSpeed'=>4
                // 'MainBatteryDisconnected'=>3,
                // 'LowBattery'=>4,
                // 'LowBatteryRemoved'=>5,
                // 'MainBatteryConnected'=>6,
                // 'GPSBOXOpen'=>9,
                // 'EmergencyON'=>10,
                // 'EmergencyOFF'=>11,
                // 'ParameterChange'=>12,
                // 'HarshBreaking'=>13,
                // 'HarshAcceleration'=>14,
                // 'RashTurning'=>15,
                // 'DeviceTempered'=>16,
            );

        foreach ($data as $key => $value) {
        	AlertTypeMaster::create([
                'name' => $key,
	            'message_id' => $value,
	        ]);
        }

    }
}
