<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateTalentDataCsv extends Command
{
    protected $signature   = 'talentsourcing:generate-talent-csv';
    protected $description = 'Generate CSV file with name, surname, email, password and up to 10 stacks';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Collecting data...');

        $file_name = storage_path('talents.csv');
        $handle = fopen($file_name, 'w');

        DB::table('talents')
            ->selectRaw('talents.id, first_name, last_name, email')
            ->selectRaw("(CASE WHEN talent_data.name = 'password' THEN talent_data.value END) AS password")
            ->selectRaw("GROUP_CONCAT(skills.name) AS skills")
            ->join('talent_skills', 'talents.id', 'talent_skills.talent_id')
            ->join('talent_data', 'talent_data.talent_id', 'talents.id')
            ->join('skills', 'talent_skills.skill_id', 'skills.id')
            ->groupBy('email')
            ->get()
            ->each(function ($record) use ($handle) {
                $record->skills = collect(array_map('trim', explode(',', $record->skills)))->take(10)->implode(', ');

                fputcsv($handle, collect($record)->toArray());
            });

        fclose($handle);

        $this->info("CSV generated at ");
        $this->comment("\n{$file_name}\n");

        return Command::SUCCESS;
    }
}
