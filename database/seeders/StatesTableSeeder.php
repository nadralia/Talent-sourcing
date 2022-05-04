<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        if (! $file = fopen(base_path('database/seeders/states.csv'), 'r')) {
            return;
        }
  
        $not_eof = false;

        while (($item = fgetcsv($file, 0, ',')) !== FALSE) {
            if ($not_eof) {
                DB::table('states')->updateOrInsert(
                    [ 'id' => $item[0] ],
                    [ 'country_id' => $item[1], 'name' => $item[2] ]
                );  
            }

            $not_eof = true;
        }

        fclose($file);
    }
}