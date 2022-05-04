<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class TalentPermissionSeeder extends Seeder
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
                'id'   => 274,
                'name' => 'list.dashboard',
            ],

            [
                'id'   => 275,
                'name' => 'create.dashboard',
            ],

            [
                'id'   => 276,
                'name' => 'edit.dashboard',
            ],

            [
                'id'   => 277,
                'name' => 'delete.dashboard',
            ],

            [
                'id'   => 278,
                'name' => 'list.role',
            ],
            [
                'id'   => 279,
                'name' => 'create.role',
            ],
            [
                'id'   => 280,
                'name' => 'edit.role',
            ],
            [
                'id'   => 281,
                'name' => 'delete.role',
            ],
            [
                'id'   => 282,
                'name' => 'download.role',
            ],

            [
                'id'   => 283,
                'name' => 'export.role',
            ],

            [
                'id'   => 284,
                'name' => 'list.report',
            ],
            [
                'id'   => 285,
                'name' => 'create.report',
            ],
            [
                'id'   => 286,
                'name' => 'edit.report',
            ],
            [
                'id'   => 287,
                'name' => 'delete.report',
            ],
            [
                'id'   => 288,
                'name' => 'download.report',
            ],

            [
                'id'   => 289,
                'name' => 'export.reports',
            ],

            [
                'id'   => 280,
                'name' => 'list.reports',
            ],
            [
                'id'   => 281,
                'name' => 'create.reports',
            ],
            [
                'id'   => 282,
                'name' => 'edit.reports',
            ],
            [
                'id'   => 283,
                'name' => 'delete.reports',
            ],
            [
                'id'   => 284,
                'name' => 'download.reports',
            ],

            // [
            //     'id'   => 285,
            //     'name' => 'export.reports',
            // ],

            [
                'id'   => 286,
                'name' => 'list.business',
            ],
            [
                'id'   => 287,
                'name' => 'create.business',
            ],
            [
                'id'   => 288,
                'name' => 'edit.business',
            ],
            [
                'id'   => 289,
                'name' => 'delete.business',
            ],

            [
                'id'   => 290,
                'name' => 'download.business',
            ],

            [
                'id'   => 291,
                'name' => 'export.business',
            ],

            [
                'id'   => 292,
                'name' => 'list.businesses',
            ],
            [
                'id'   => 293,
                'name' => 'create.businesses',
            ],
            [
                'id'   => 294,
                'name' => 'edit.businesses',
            ],
            [
                'id'   => 295,
                'name' => 'delete.businesses',
            ],

            [
                'id'   => 296,
                'name' => 'download.businesses',
            ],

            [
                'id'   => 297,
                'name' => 'export.businesses',
            ],

            [
                'id'   => 298,
                'name' => 'list.codebases',
            ],
            [
                'id'   => 299,
                'name' => 'create.codebases',
            ],

            [
                'id'   => 300,
                'name' => 'edit.codebases',
            ],

            [
                'id'   => 301,
                'name' => 'delete.codebases',
            ],

            [
                'id'   => 302,
                'name' => 'download.codebases',
            ],

            [
                'id'   => 302,
                'name' => 'export.codebases',
            ],

            [
                'id'   => 303,
                'name' => 'list.codebaseskills',
            ],
            [
                'id'   => 304,
                'name' => 'create.codebaseskills',
            ],

            [
                'id'   => 305,
                'name' => 'edit.codebaseskills',
            ],

            [
                'id'   => 306,
                'name' => 'delete.codebaseskills',
            ],

            [
                'id'   => 307,
                'name' => 'download.codebaseskills',
            ],

            [
                'id'   => 308,
                'name' => 'export.codebaseskills',
            ],

            [
                'id'   => 309,
                'name' => 'list.countries',
            ],
            [
                'id'   => 310,
                'name' => 'create.countries',
            ],

            [
                'id'   => 311,
                'name' => 'edit.countries',
            ],

            [
                'id'   => 312,
                'name' => 'delete.countries',
            ],

            [
                'id'   => 313,
                'name' => 'download.countries',
            ],

            [
                'id'   => 314,
                'name' => 'export.countries',
            ],

            [
                'id'   => 315,
                'name' => 'list.coverletter',
            ],
            [
                'id'   => 316,
                'name' => 'create.coverletter',
            ],

            [
                'id'   => 317,
                'name' => 'edit.coverletter',
            ],

            [
                'id'   => 318,
                'name' => 'delete.coverletter',
            ],

            [
                'id'   => 319,
                'name' => 'download.coverletter',
            ],

            [
                'id'   => 320,
                'name' => 'export.coverletter',
            ],


            [
                'id'   => 321,
                'name' => 'list.coverletters',
            ],
            [
                'id'   => 322,
                'name' => 'create.coverletters',
            ],

            [
                'id'   => 323,
                'name' => 'edit.coverletters',
            ],

            [
                'id'   => 324,
                'name' => 'delete.coverletters',
            ],

            [
                'id'   => 325,
                'name' => 'download.coverletters',
            ],

            [
                'id'   => 326,
                'name' => 'export.coverletters',
            ],


            [
                'id'   => 327,
                'name' => 'list.currencies',
            ],
            [
                'id'   => 328,
                'name' => 'create.currencies',
            ],

            [
                'id'   => 329,
                'name' => 'edit.currencies',
            ],

            [
                'id'   => 330,
                'name' => 'delete.currencies',
            ],

            [
                'id'   => 331,
                'name' => 'download.currencies',
            ],

            [
                'id'   => 332,
                'name' => 'export.currencies',
            ],


            [
                'id'   => 333,
                'name' => 'list.degree',
            ],
            [
                'id'   => 334,
                'name' => 'create.degree',
            ],

            [
                'id'   => 335,
                'name' => 'edit.degree',
            ],

            [
                'id'   => 336,
                'name' => 'delete.degree',
            ],

            [
                'id'   => 337,
                'name' => 'download.degree',
            ],

            [
                'id'   => 338,
                'name' => 'export.degree',
            ],


            [
                'id'   => 339,
                'name' => 'list.degrees',
            ],
            [
                'id'   => 340,
                'name' => 'create.degrees',
            ],

            [
                'id'   => 341,
                'name' => 'edit.degrees',
            ],

            [
                'id'   => 342,
                'name' => 'delete.degrees',
            ],

            [
                'id'   => 343,
                'name' => 'download.degrees',
            ],

            [
                'id'   => 344,
                'name' => 'export.degrees',
            ],


            [
                'id'   => 345,
                'name' => 'list.education',
            ],
            [
                'id'   => 346,
                'name' => 'create.education',
            ],

            [
                'id'   => 347,
                'name' => 'edit.education',
            ],

            [
                'id'   => 348,
                'name' => 'delete.education',
            ],

            [
                'id'   => 349,
                'name' => 'download.education',
            ],

            [
                'id'   => 350,
                'name' => 'export.education',
            ],

            [
                'id'   => 351,
                'name' => 'list.educations',
            ],
            [
                'id'   => 352,
                'name' => 'create.educations',
            ],

            [
                'id'   => 353,
                'name' => 'edit.educations',
            ],

            [
                'id'   => 354,
                'name' => 'delete.educations',
            ],

            [
                'id'   => 355,
                'name' => 'download.educations',
            ],

            [
                'id'   => 356,
                'name' => 'export.educations',
            ],


            [
                'id'   => 357,
                'name' => 'list.employee',
            ],
            [
                'id'   => 358,
                'name' => 'create.employee',
            ],

            [
                'id'   => 359,
                'name' => 'edit.employee',
            ],

            [
                'id'   => 360,
                'name' => 'delete.employee',
            ],

            [
                'id'   => 361,
                'name' => 'download.employee',
            ],

            [
                'id'   => 362,
                'name' => 'export.employee',
            ],

            [
                'id'   => 363,
                'name' => 'list.employees',
            ],
            [
                'id'   => 364,
                'name' => 'create.employees',
            ],

            [
                'id'   => 365,
                'name' => 'edit.employees',
            ],

            [
                'id'   => 366,
                'name' => 'delete.employees',
            ],

            [
                'id'   => 367,
                'name' => 'download.employees',
            ],

            [
                'id'   => 368,
                'name' => 'export.employees',
            ],


            [
                'id'   => 369,
                'name' => 'list.experience',
            ],
            [
                'id'   => 370,
                'name' => 'create.experience',
            ],

            [
                'id'   => 371,
                'name' => 'edit.experience',
            ],

            [
                'id'   => 372,
                'name' => 'delete.experience',
            ],

            [
                'id'   => 373,
                'name' => 'download.experience',
            ],

            [
                'id'   => 374,
                'name' => 'export.experience',
            ],


            [
                'id'   => 375,
                'name' => 'list.experiences',
            ],
            [
                'id'   => 376,
                'name' => 'create.experiences',
            ],

            [
                'id'   => 377,
                'name' => 'edit.experiences',
            ],

            [
                'id'   => 378,
                'name' => 'delete.experiences',
            ],

            [
                'id'   => 379,
                'name' => 'download.experiences',
            ],

            [
                'id'   => 380,
                'name' => 'export.experiences',
            ],


            [
                'id'   => 381,
                'name' => 'list.forex',
            ],
            [
                'id'   => 382,
                'name' => 'create.forex',
            ],

            [
                'id'   => 383,
                'name' => 'edit.forex',
            ],

            [
                'id'   => 384,
                'name' => 'delete.forex',
            ],

            [
                'id'   => 385,
                'name' => 'download.forex',
            ],

            [
                'id'   => 386,
                'name' => 'export.forex',
            ],

            [
                'id'   => 387,
                'name' => 'list.genders',
            ],
            [
                'id'   => 388,
                'name' => 'create.genders',
            ],

            [
                'id'   => 389,
                'name' => 'edit.genders',
            ],

            [
                'id'   => 390,
                'name' => 'delete.genders',
            ],

            [
                'id'   => 391,
                'name' => 'download.genders',
            ],

            [
                'id'   => 392,
                'name' => 'export.genders',
            ],
            [
                'id'   => 393,
                'name' => 'list.languages',
            ],
            [
                'id'   => 394,
                'name' => 'create.languages',
            ],

            [
                'id'   => 395,
                'name' => 'edit.languages',
            ],

            [
                'id'   => 396,
                'name' => 'delete.languages',
            ],
            [
                'id'   => 397,
                'name' => 'download.languages',
            ],

            [
                'id'   => 398,
                'name' => 'export.languages',
            ],
        ];


        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                [ 'id'   => $permission['id'] ],
                [ 'name' => $permission['name'], 'guard_name' => 'talent' ]
            );
        }
    }
}
