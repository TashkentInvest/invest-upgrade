<?php

namespace Database\Seeders\init;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\About;

class AboutCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aboutJson = json_decode( file_get_contents(__DIR__."/../references/about_company.json") );
        echo "ABOUT::inserting".PHP_EOL;
        foreach($aboutJson as $about)
		{
			$item = new About();
            $item->name_uz = $about->name_uz;
            $item->name_ru = $about->name_ru;
            $item->text_uz = $about->text_uz;
            $item->text_ru = $about->text_ru;
            $item->image = $about->image;
			$item->save();
		}
    }
}
