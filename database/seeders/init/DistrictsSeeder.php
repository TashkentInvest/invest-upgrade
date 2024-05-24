<?php

namespace Database\Seeders\init;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Regions;
use App\Models\Districts;

class DistrictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districtsJson = file_get_contents(__DIR__."/../references/districts.json");
        $districtsArray = json_decode( $districtsJson );
        echo "Districts::inserting".PHP_EOL;
		foreach($districtsArray as $districtObject)
		{
            $region = Regions::where('static_id', $districtObject->region_id)->first();
            if($region)
            {
                $district = new Districts();
                $district->region_id = $region->id;
                $district->name_uz = $districtObject->name_uz;
                $district->name_ru = $districtObject->name_ru;
                $district->save();
            }
		}
    }
}
