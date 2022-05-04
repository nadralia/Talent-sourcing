<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class BusinessPermissionSeeder extends Seeder
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
                'id'   => 138,
                'name' => 'list.dashboard',
            ],

            [
                'id'   => 139,
                'name' => 'create.dashboard',
            ],

            [
                'id'   => 140,
                'name' => 'edit.dashboard',
            ],

            [
                'id'   => 141,
                'name' => 'delete.dashboard',
            ],

            [
                'id'   => 142,
                'name' => 'list.role',
            ],
            [
                'id'   => 143,
                'name' => 'create.role',
            ],
            [
                'id'   => 144,
                'name' => 'edit.role',
            ],
            [
                'id'   => 145,
                'name' => 'delete.role',
            ],
            [
                'id'   => 146,
                'name' => 'download.role',
            ],

            [
                'id'   => 147,
                'name' => 'export.role',
            ],

            [
                'id'   => 148,
                'name' => 'list.report',
            ],
            [
                'id'   => 149,
                'name' => 'create.report',
            ],
            [
                'id'   => 150,
                'name' => 'edit.report',
            ],
            [
                'id'   => 151,
                'name' => 'delete.report',
            ],
            [
                'id'   => 152,
                'name' => 'download.report',
            ],

            // [
            //     'id'   => 153,
            //     'name' => 'export.reports',
            // ],

            [
                'id'   => 154,
                'name' => 'list.reports',
            ],
            [
                'id'   => 155,
                'name' => 'create.reports',
            ],
            [
                'id'   => 156,
                'name' => 'edit.reports',
            ],
            [
                'id'   => 157,
                'name' => 'delete.reports',
            ],
            [
                'id'   => 158,
                'name' => 'download.reports',
            ],

            [
                'id'   => 159,
                'name' => 'export.reports',
            ],

            [
                'id'   => 160,
                'name' => 'list.business',
            ],
            [
                'id'   => 161,
                'name' => 'create.business',
            ],
            [
                'id'   => 162,
                'name' => 'edit.business',
            ],
            [
                'id'   => 163,
                'name' => 'delete.business',
            ],

            [
                'id'   => 164,
                'name' => 'download.business',
            ],

            [
                'id'   => 165,
                'name' => 'export.business',
            ],


            [
                'id'   => 166,
                'name' => 'list.businesses',
            ],
            [
                'id'   => 167,
                'name' => 'create.businesses',
            ],
            [
                'id'   => 168,
                'name' => 'edit.businesses',
            ],
            [
                'id'   => 169,
                'name' => 'delete.businesses',
            ],

            [
                'id'   => 170,
                'name' => 'download.businesses',
            ],

            [
                'id'   => 171,
                'name' => 'export.businesses',
            ],

            [
                'id'   => 172,
                'name' => 'list.codebases',
            ],
            [
                'id'   => 173,
                'name' => 'create.codebases',
            ],

            [
                'id'   => 174,
                'name' => 'edit.codebases',
            ],

            [
                'id'   => 175,
                'name' => 'delete.codebases',
            ],

            [
                'id'   => 176,
                'name' => 'download.codebases',
            ],

            [
                'id'   => 177,
                'name' => 'export.codebases',
            ],

            [
                'id'   => 178,
                'name' => 'list.codebaseskills',
            ],
            [
                'id'   => 179,
                'name' => 'create.codebaseskills',
            ],

            [
                'id'   => 180,
                'name' => 'edit.codebaseskills',
            ],

            [
                'id'   => 181,
                'name' => 'delete.codebaseskills',
            ],

            [
                'id'   => 182,
                'name' => 'download.codebaseskills',
            ],

            [
                'id'   => 183,
                'name' => 'export.codebaseskills',
            ],

            [
                'id'   => 184,
                'name' => 'list.countries',
            ],
            [
                'id'   => 185,
                'name' => 'create.countries',
            ],

            [
                'id'   => 186,
                'name' => 'edit.countries',
            ],

            [
                'id'   => 187,
                'name' => 'delete.countries',
            ],

            [
                'id'   => 188,
                'name' => 'download.countries',
            ],

            [
                'id'   => 189,
                'name' => 'export.countries',
            ],

            [
                'id'   => 190,
                'name' => 'list.coverletter',
            ],
            [
                'id'   => 191,
                'name' => 'create.coverletter',
            ],

            [
                'id'   => 192,
                'name' => 'edit.coverletter',
            ],

            [
                'id'   => 193,
                'name' => 'delete.coverletter',
            ],

            [
                'id'   => 194,
                'name' => 'download.coverletter',
            ],

            [
                'id'   => 195,
                'name' => 'export.coverletter',
            ],


            [
                'id'   => 196,
                'name' => 'list.coverletters',
            ],
            [
                'id'   => 197,
                'name' => 'create.coverletters',
            ],

            [
                'id'   => 198,
                'name' => 'edit.coverletters',
            ],

            [
                'id'   => 199,
                'name' => 'delete.coverletters',
            ],

            [
                'id'   => 200,
                'name' => 'download.coverletters',
            ],

            [
                'id'   => 201,
                'name' => 'export.coverletters',
            ],


            [
                'id'   => 202,
                'name' => 'list.currencies',
            ],
            [
                'id'   => 203,
                'name' => 'create.currencies',
            ],

            [
                'id'   => 204,
                'name' => 'edit.currencies',
            ],

            [
                'id'   => 205,
                'name' => 'delete.currencies',
            ],

            [
                'id'   => 206,
                'name' => 'download.currencies',
            ],

            [
                'id'   => 207,
                'name' => 'export.currencies',
            ],


            [
                'id'   => 208,
                'name' => 'list.degree',
            ],
            [
                'id'   => 209,
                'name' => 'create.degree',
            ],

            [
                'id'   => 210,
                'name' => 'edit.degree',
            ],

            [
                'id'   => 211,
                'name' => 'delete.degree',
            ],

            [
                'id'   => 212,
                'name' => 'download.degree',
            ],

            [
                'id'   => 213,
                'name' => 'export.degree',
            ],


            [
                'id'   => 214,
                'name' => 'list.degrees',
            ],
            [
                'id'   => 215,
                'name' => 'create.degrees',
            ],

            [
                'id'   => 216,
                'name' => 'edit.degrees',
            ],

            [
                'id'   => 217,
                'name' => 'delete.degrees',
            ],

            [
                'id'   => 218,
                'name' => 'download.degrees',
            ],

            [
                'id'   => 219,
                'name' => 'export.degrees',
            ],


            [
                'id'   => 220,
                'name' => 'list.education',
            ],
            [
                'id'   => 221,
                'name' => 'create.education',
            ],

            [
                'id'   => 222,
                'name' => 'edit.education',
            ],

            [
                'id'   => 223,
                'name' => 'delete.education',
            ],

            [
                'id'   => 224,
                'name' => 'download.education',
            ],

            [
                'id'   => 225,
                'name' => 'export.education',
            ],

            [
                'id'   => 226,
                'name' => 'list.educations',
            ],
            [
                'id'   => 227,
                'name' => 'create.educations',
            ],

            [
                'id'   => 228,
                'name' => 'edit.educations',
            ],

            [
                'id'   => 229,
                'name' => 'delete.educations',
            ],

            [
                'id'   => 230,
                'name' => 'download.educations',
            ],

            [
                'id'   => 231,
                'name' => 'export.educations',
            ],


            [
                'id'   => 232,
                'name' => 'list.employee',
            ],
            [
                'id'   => 233,
                'name' => 'create.employee',
            ],

            [
                'id'   => 234,
                'name' => 'edit.employee',
            ],

            [
                'id'   => 235,
                'name' => 'delete.employee',
            ],

            [
                'id'   => 236,
                'name' => 'download.employee',
            ],

            [
                'id'   => 237,
                'name' => 'export.employee',
            ],

            [
                'id'   => 238,
                'name' => 'list.employees',
            ],
            [
                'id'   => 239,
                'name' => 'create.employees',
            ],

            [
                'id'   => 240,
                'name' => 'edit.employees',
            ],

            [
                'id'   => 241,
                'name' => 'delete.employees',
            ],

            [
                'id'   => 242,
                'name' => 'download.employees',
            ],

            [
                'id'   => 243,
                'name' => 'export.employees',
            ],


            [
                'id'   => 244,
                'name' => 'list.experience',
            ],
            [
                'id'   => 245,
                'name' => 'create.experience',
            ],

            [
                'id'   => 246,
                'name' => 'edit.experience',
            ],

            [
                'id'   => 247,
                'name' => 'delete.experience',
            ],

            [
                'id'   => 248,
                'name' => 'download.experience',
            ],

            [
                'id'   => 249,
                'name' => 'export.experience',
            ],


            [
                'id'   => 250,
                'name' => 'list.experiences',
            ],
            [
                'id'   => 251,
                'name' => 'create.experiences',
            ],

            [
                'id'   => 252,
                'name' => 'edit.experiences',
            ],

            [
                'id'   => 253,
                'name' => 'delete.experiences',
            ],

            [
                'id'   => 254,
                'name' => 'download.experiences',
            ],

            [
                'id'   => 255,
                'name' => 'export.experiences',
            ],


            [
                'id'   => 256,
                'name' => 'list.forex',
            ],
            [
                'id'   => 257,
                'name' => 'create.forex',
            ],

            [
                'id'   => 258,
                'name' => 'edit.forex',
            ],

            [
                'id'   => 259,
                'name' => 'delete.forex',
            ],

            [
                'id'   => 260,
                'name' => 'download.forex',
            ],

            [
                'id'   => 261,
                'name' => 'export.forex',
            ],

            [
                'id'   => 262,
                'name' => 'list.genders',
            ],
            [
                'id'   => 263,
                'name' => 'create.genders',
            ],

            [
                'id'   => 264,
                'name' => 'edit.genders',
            ],

            [
                'id'   => 265,
                'name' => 'delete.genders',
            ],

            [
                'id'   => 266,
                'name' => 'download.genders',
            ],

            [
                'id'   => 267,
                'name' => 'export.genders',
            ],
            [
                'id'   => 268,
                'name' => 'list.languages',
            ],
            [
                'id'   => 269,
                'name' => 'create.languages',
            ],

            [
                'id'   => 270,
                'name' => 'edit.languages',
            ],

            [
                'id'   => 271,
                'name' => 'delete.languages',
            ],
            [
                'id'   => 272,
                'name' => 'download.languages',
            ],

            [
                'id'   => 273,
                'name' => 'export.languages',
            ],
        ];


        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                [ 'id'   => $permission['id'] ],
                [ 'name' => $permission['name'], 'guard_name' => 'business' ]
            );
        }
    }
}
