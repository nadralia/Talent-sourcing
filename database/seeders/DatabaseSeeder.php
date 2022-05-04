<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(NoticePeriodsTableSeeder::class);
        $this->call(IndustriesTableSeeder::class);
        $this->call(DegreesTableSeeder::class);
        $this->call(GendersTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(RemoteTypesTableSeeder::class);
        $this->call(SenioritiesTableSeeder::class);
        $this->call(SkillLevelsTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(TitlesTableSeeder::class);
        $this->call(VettingStagesTableSeeder::class);
        $this->call(AdminRolesSeeder::class);
        $this->call(BusinessRolesSeeder::class);
        $this->call(TalentRoleSeeder::class);
        $this->call(TalentPermissionSeeder::class);
        $this->call(AdminPermissionSeeder::class);
        $this->call(BusinessPermissionSeeder::class);
        $this->call(LanguageLevelesSeeder::class);
        $this->call(JobStatusSeeder::class);
        $this->call(CultureFitCategoriesSeeder::class);
        $this->call(CultureFitSeeder::class);
    }
}
