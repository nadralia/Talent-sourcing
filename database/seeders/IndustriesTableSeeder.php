<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $list = [
            0 => 
            [
                'id'         => 1,
                'name'       => 'Advertising/Public Relations',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            1 => 
            [
                'id'         => 2,
                'name'       => 'Agriculture',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            2 => 
            [
                'id'         => 3,
                'name'       => 'Banking & Finance',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            3 => 
            [
                'id'         => 4,
                'name'       => 'Cable & Satellite TV Production & Distributio',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            4 => 
            [
                'id'         => 5,
                'name'       => 'Clothing & Apparel',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            5 => 
            [
                'id'         => 6,
                'name'       => 'Software As A Services',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            6 => 
            [
                'id'         => 9,
                'name'       => 'Antiques & Collectibles',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            7 => 
            [
                'id'         => 12,
                'name'       => 'Arts & Entertainment',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            8 => 
            [
                'id'         => 14,
                'name'       => 'Autos & Vehicles',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            9 => 
            [
                'id'         => 15,
                'name'       => 'Beauty & Fitness',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            10 => 
            [
                'id'         => 16,
                'name'       => 'Books & Literature',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            11 => 
            [
                'id'         => 17,
                'name'       => 'Business & Industrial',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            12 => 
            [
                'id'         => 18,
                'name'       => 'Computer & Networking',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            13 => 
            [
                'id'         => 19,
                'name'       => 'Consumer Electronics',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            14 => 
            [
                'id'         => 20,
                'name'       => 'Coupons & Discounts',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            15 => 
            [
                'id'         => 23,
                'name'       => 'Food & Drink',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            16 => 
            [
                'id'         => 24,
                'name'       => 'Games',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            17 => 
            [
                'id'         => 25,
                'name'       => 'Gifts & Special Events',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            18 => 
            [
                'id'         => 26,
                'name'       => 'Health',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            19 => 
            [
                'id'         => 27,
                'name'       => 'Hospitality',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            20 => 
            [
                'id'         => 28,
                'name'       => 'Hardware',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            21 => 
            [
                'id'   => 29,
                'name' => '3D Printing
',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            22 => 
            [
                'id'         => 30,
                'name'       => 'AdTech',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            23 => 
            [
                'id'         => 31,
                'name'       => 'AgriTech',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            24 => 
            [
                'id'         => 32,
                'name'       => 'AR & VR',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            25 => 
            [
                'id'         => 33,
                'name'       => 'B2B',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            26 => 
            [
                'id'         => 34,
                'name'       => 'Big Data & Analytics',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            27 => 
            [
                'id'         => 35,
                'name'       => 'BioPharma',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            28 => 
            [
                'id'         => 36,
                'name'       => 'CleanTech',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            29 => 
            [
                'id'         => 37,
                'name'       => 'Crypto & Blockchain',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            30 => 
            [
                'id'         => 38,
                'name'       => 'Cybersecurity',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
            31 => 
            [
                'id'         => 39,
                'name'       => 'AR/VR',
                'enabled'    => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-02-07 20:14:57',
                'updated_at' => '2022-02-07 20:14:57',
            ],
        ];
        
        foreach ($list as $item) {
            DB::table('industries')->updateOrInsert( [ 'id' => $item['id'] ], $item);
        }
    }
}