<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class BusinessRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'   => 7,
                'name' => 'admin',
            ],
            [
                'id'   => 8,
                'name' => 'master',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                [ 'id' => $role['id'] ],
                [ 'name'  => $role['name'], 'guard_name' => 'business' ]
            );
        }
    }
}
