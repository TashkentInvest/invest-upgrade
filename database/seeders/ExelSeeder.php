<?php
namespace Database\Seeders\init;


use Illuminate\Database\Seeder;

class ExelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $exelJson = json_decode( file_get_contents(__DIR__."/../references/exel.json") );
        echo "EXEL::inserting".PHP_EOL;
		foreach($exelJson as $item)
		{
            print($item);
			// $role = new RoleGroup();
            // $role->name = $item->name;
            // $role->guard_name = $item->guard_name;
            // $role->title = $item->title;
			// $role->save();
		}
    }
}

