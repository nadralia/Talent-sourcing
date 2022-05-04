<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MoveJobSkillsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'talentsourcing:move-job-skills-data
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Move data from the jobs_skills table in the old DB into the vacancy_skills table in the new DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating job skills into vacancy skills');
            
        $migrated_vacancy_skills = DB::table('vacancy_skills');

        $old_vacancy_skills = DB::connection('base_app_old')->table('jobs_skills')
            ->join('jobs', 'jobs.id', 'jobs_skills.job_id')
            ->join('clients', 'clients.id', 'jobs.client_id')
            ->selectRaw('jobs_skills.*, jobs.id AS vacancy_id, clients.id as business_id');

        if ($migrated_vacancy_skills && ! $this->option('overwrite')) {
            $old_vacancy_skills
                ->whereNotIn('job_id', $migrated_vacancy_skills->pluck('vacancy_id'))
                ->whereNotIn('skill_id', $migrated_vacancy_skills->pluck('skill_id'));
        }

        $old_vacancy_skills = $old_vacancy_skills->get();

        if (! $old_vacancy_skills->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_vacancy_skills->count());

        $old_vacancy_skills->each(function ($row) {
            $this->output->progressAdvance();

            DB::table('vacancy_skills')->updateOrInsert(
                [
                    'vacancy_id' => $row->vacancy_id,
                    'skill_id'   => $row->skill_id,
                ],
                [
                    'business_id' => $row->business_id,
                    'must_have'   => 1,
                ]
            );
        });

        $this->output->progressFinish();

        $this->info('Done migrating vacnacy skills data');
        $this->line('');

        return Command::SUCCESS;
    }
}
