<?php

namespace Database\Seeders\init;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Programs;

class ProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programsArray = json_decode(file_get_contents(__DIR__."/../references/programs.json"));
        echo "Programs::inserting".PHP_EOL;
		foreach($programsArray as $program)
		{
            $item = new Programs();
            $item->name_uz = $program->name_uz;
            $item->name_ru = $program->name_ru;
            $item->save();
		}
    }
}
