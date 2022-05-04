<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'id'   => 1,
                'name' => 'list.dashboard',
            ],

            [
                'id'   => 2,
                'name' => 'create.dashboard',
            ],

            [
                'id'   => 3,
                'name' => 'edit.dashboard',
            ],

            [
                'id'   => 4,
                'name' => 'delete.dashboard',
            ],

            [
                'id'   => 5,
                'name' => 'list.role',
            ],
            [
                'id'   => 6,
                'name' => 'create.role',
            ],
            [
                'id'   => 7,
                'name' => 'edit.role',
            ],
            [
                'id'   => 8,
                'name' => 'delete.role',
            ],
            [
                'id'   => 9,
                'name' => 'download.role',
            ],

            [
                'id'   => 10,
                'name' => 'export.role',
            ],

            [
                'id'   => 11,
                'name' => 'list.report',
            ],
            [
                'id'   => 12,
                'name' => 'create.report',
            ],
            [
                'id'   => 13,
                'name' => 'edit.report',
            ],
            [
                'id'   => 14,
                'name' => 'delete.report',
            ],
            [
                'id'   => 15,
                'name' => 'download.report',
            ],

            // [
            //     'id'   => 16,
            //     'name' => 'export.reports',
            // ],

            [
                'id'   => 17,
                'name' => 'list.reports',
            ],
            [
                'id'   => 18,
                'name' => 'create.reports',
            ],
            [
                'id'   => 19,
                'name' => 'edit.reports',
            ],
            [
                'id'   => 20,
                'name' => 'delete.reports',
            ],
            [
                'id'   => 21,
                'name' => 'download.reports',
            ],

            [
                'id'   => 22,
                'name' => 'export.reports',
            ],

            [
                'id'   => 23,
                'name' => 'list.business',
            ],
            [
                'id'   => 24,
                'name' => 'create.business',
            ],
            [
                'id'   => 25,
                'name' => 'edit.business',
            ],
            [
                'id'   => 26,
                'name' => 'delete.business',
            ],

            [
                'id'   => 27,
                'name' => 'download.business',
            ],

            [
                'id'   => 28,
                'name' => 'export.business',
            ],


            [
                'id'   => 29,
                'name' => 'list.businesses',
            ],
            [
                'id'   => 30,
                'name' => 'create.businesses',
            ],
            [
                'id'   => 31,
                'name' => 'edit.businesses',
            ],
            [
                'id'   => 32,
                'name' => 'delete.businesses',
            ],

            [
                'id'   => 33,
                'name' => 'download.businesses',
            ],

            [
                'id'   => 34,
                'name' => 'export.businesses',
            ],

            [
                'id'   => 35,
                'name' => 'list.codebases',
            ],
            [
                'id'   => 36,
                'name' => 'create.codebases',
            ],

            [
                'id'   => 37,
                'name' => 'edit.codebases',
            ],

            [
                'id'   => 38,
                'name' => 'delete.codebases',
            ],

            [
                'id'   => 39,
                'name' => 'download.codebases',
            ],

            [
                'id'   => 40,
                'name' => 'export.codebases',
            ],

            [
                'id'   => 41,
                'name' => 'list.codebaseskills',
            ],
            [
                'id'   => 42,
                'name' => 'create.codebaseskills',
            ],

            [
                'id'   => 43,
                'name' => 'edit.codebaseskills',
            ],

            [
                'id'   => 44,
                'name' => 'delete.codebaseskills',
            ],

            [
                'id'   => 45,
                'name' => 'download.codebaseskills',
            ],

            [
                'id'   => 46,
                'name' => 'export.codebaseskills',
            ],

            [
                'id'   => 47,
                'name' => 'list.countries',
            ],
            [
                'id'   => 48,
                'name' => 'create.countries',
            ],

            [
                'id'   => 49,
                'name' => 'edit.countries',
            ],

            [
                'id'   => 50,
                'name' => 'delete.countries',
            ],

            [
                'id'   => 51,
                'name' => 'download.countries',
            ],

            [
                'id'   => 52,
                'name' => 'export.countries',
            ],

            [
                'id'   => 53,
                'name' => 'list.coverletter',
            ],
            [
                'id'   => 54,
                'name' => 'create.coverletter',
            ],

            [
                'id'   => 55,
                'name' => 'edit.coverletter',
            ],

            [
                'id'   => 56,
                'name' => 'delete.coverletter',
            ],

            [
                'id'   => 57,
                'name' => 'download.coverletter',
            ],

            [
                'id'   => 58,
                'name' => 'export.coverletter',
            ],


            [
                'id'   => 59,
                'name' => 'list.coverletters',
            ],
            [
                'id'   => 60,
                'name' => 'create.coverletters',
            ],

            [
                'id'   => 61,
                'name' => 'edit.coverletters',
            ],

            [
                'id'   => 62,
                'name' => 'delete.coverletters',
            ],

            [
                'id'   => 63,
                'name' => 'download.coverletters',
            ],

            [
                'id'   => 64,
                'name' => 'export.coverletters',
            ],


            [
                'id'   => 65,
                'name' => 'list.currencies',
            ],
            [
                'id'   => 66,
                'name' => 'create.currencies',
            ],

            [
                'id'   => 67,
                'name' => 'edit.currencies',
            ],

            [
                'id'   => 68,
                'name' => 'delete.currencies',
            ],

            [
                'id'   => 69,
                'name' => 'download.currencies',
            ],

            [
                'id'   => 70,
                'name' => 'export.currencies',
            ],


            [
                'id'   => 71,
                'name' => 'list.degree',
            ],
            [
                'id'   => 72,
                'name' => 'create.degree',
            ],

            [
                'id'   => 73,
                'name' => 'edit.degree',
            ],

            [
                'id'   => 74,
                'name' => 'delete.degree',
            ],

            [
                'id'   => 75,
                'name' => 'download.degree',
            ],

            [
                'id'   => 76,
                'name' => 'export.degree',
            ],


            [
                'id'   => 77,
                'name' => 'list.degrees',
            ],
            [
                'id'   => 78,
                'name' => 'create.degrees',
            ],

            [
                'id'   => 79,
                'name' => 'edit.degrees',
            ],

            [
                'id'   => 80,
                'name' => 'delete.degrees',
            ],

            [
                'id'   => 81,
                'name' => 'download.degrees',
            ],

            [
                'id'   => 82,
                'name' => 'export.degrees',
            ],


            [
                'id'   => 83,
                'name' => 'list.education',
            ],
            [
                'id'   => 84,
                'name' => 'create.education',
            ],

            [
                'id'   => 85,
                'name' => 'edit.education',
            ],

            [
                'id'   => 86,
                'name' => 'delete.education',
            ],

            [
                'id'   => 87,
                'name' => 'download.education',
            ],

            [
                'id'   => 89,
                'name' => 'export.education',
            ],

            [
                'id'   => 90,
                'name' => 'list.educations',
            ],
            [
                'id'   => 91,
                'name' => 'create.educations',
            ],

            [
                'id'   => 92,
                'name' => 'edit.educations',
            ],

            [
                'id'   => 93,
                'name' => 'delete.educations',
            ],

            [
                'id'   => 94,
                'name' => 'download.educations',
            ],

            [
                'id'   => 95,
                'name' => 'export.educations',
            ],


            [
                'id'   => 96,
                'name' => 'list.employee',
            ],
            [
                'id'   => 97,
                'name' => 'create.employee',
            ],

            [
                'id'   => 98,
                'name' => 'edit.employee',
            ],

            [
                'id'   => 99,
                'name' => 'delete.employee',
            ],

            [
                'id'   => 100,
                'name' => 'download.employee',
            ],

            [
                'id'   => 101,
                'name' => 'export.employee',
            ],

            [
                'id'   => 102,
                'name' => 'list.employees',
            ],
            [
                'id'   => 103,
                'name' => 'create.employees',
            ],

            [
                'id'   => 104,
                'name' => 'edit.employees',
            ],

            [
                'id'   => 105,
                'name' => 'delete.employees',
            ],

            [
                'id'   => 106,
                'name' => 'download.employees',
            ],

            [
                'id'   => 107,
                'name' => 'export.employees',
            ],


            [
                'id'   => 108,
                'name' => 'list.experience',
            ],
            [
                'id'   => 109,
                'name' => 'create.experience',
            ],

            [
                'id'   => 110,
                'name' => 'edit.experience',
            ],

            [
                'id'   => 111,
                'name' => 'delete.experience',
            ],

            [
                'id'   => 112,
                'name' => 'download.experience',
            ],

            [
                'id'   => 113,
                'name' => 'export.experience',
            ],


            [
                'id'   => 114,
                'name' => 'list.experiences',
            ],
            [
                'id'   => 115,
                'name' => 'create.experiences',
            ],

            [
                'id'   => 116,
                'name' => 'edit.experiences',
            ],

            [
                'id'   => 117,
                'name' => 'delete.experiences',
            ],

            [
                'id'   => 118,
                'name' => 'download.experiences',
            ],

            [
                'id'   => 119,
                'name' => 'export.experiences',
            ],


            [
                'id'   => 120,
                'name' => 'list.forex',
            ],
            [
                'id'   => 121,
                'name' => 'create.forex',
            ],

            [
                'id'   => 122,
                'name' => 'edit.forex',
            ],

            [
                'id'   => 123,
                'name' => 'delete.forex',
            ],

            [
                'id'   => 124,
                'name' => 'download.forex',
            ],

            [
                'id'   => 125,
                'name' => 'export.forex',
            ],

            [
                'id'   => 126,
                'name' => 'list.genders',
            ],
            [
                'id'   => 127,
                'name' => 'create.genders',
            ],

            [
                'id'   => 128,
                'name' => 'edit.genders',
            ],

            [
                'id'   => 129,
                'name' => 'delete.genders',
            ],

            [
                'id'   => 130,
                'name' => 'download.genders',
            ],

            [
                'id'   => 131,
                'name' => 'export.genders',
            ],
            [
                'id'   => 132,
                'name' => 'list.languages',
            ],
            [
                'id'   => 133,
                'name' => 'create.languages',
            ],

            [
                'id'   => 134,
                'name' => 'edit.languages',
            ],

            [
                'id'   => 135,
                'name' => 'delete.languages',
            ],
            [
                'id'   => 136,
                'name' => 'download.languages',
            ],

            [
                'id'   => 137,
                'name' => 'export.languages',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                [ 'id'   => $permission['id'] ],
                [ 'name' => $permission['name'], 'guard_name' => 'admin' ]
            );
        }
    }
}
