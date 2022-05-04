<?php

namespace App\Console\Commands;

use App\Models\Resume;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MoveVacancyTalentsData extends Command
{
    protected $signature = 'talentsourcing:move-vacancy-talents
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Move data from talents_jobs table in the old DB into vacancy_talents table in the new DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating vacancy talents data');

        $migrated_talents = DB::table('vacancy_talents');

        $old_talents = DB::connection('base_app_old')->table('talents_jobs')
            ->join('talents', 'talents.id', 'talents_jobs.talent_id')
            ->join('jobs', 'jobs.id', 'talents_jobs.job_id')
            ->join('clients', 'clients.id', 'jobs.client_id')
            ->selectRaw('talents_jobs.*')
            ->selectRaw('talents.id AS talent_id, jobs.id AS vacancy_id, clients.id AS business_id');

        if ($migrated_talents && ! $this->option('overwrite')) {
            $old_talents
                ->whereNotIn('talent_id', $migrated_talents->pluck('talent_id'))
                ->whereNotIn('job_id', $migrated_talents->pluck('vacancy_id'));
        }

        $old_talents = $old_talents->get();

        if (! $old_talents->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_talents->count());

        $talent_resumes = Resume::whereIn('talent_id', $old_talents->pluck('talent_id'))->pluck('id', 'talent_id');

        $old_talents->each(function ($row) use ($talent_resumes) {
            $this->output->progressAdvance();

            if ($talent_resume = $talent_resumes[$row->talent_id] ?? null) {
                DB::table('vacancy_talents')->updateOrInsert(
                    [
                        'talent_id'  => $row->talent_id,
                        'vacancy_id' => $row->vacancy_id
                    ],
                    [
                        'business_id' => $row->business_id,
                        'resume_id'   => $talent_resume,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]
                );
            }
        });

        $this->output->progressFinish();

        $this->info('Done migrating vacancy talents data');
        $this->line('');

        return Command::SUCCESS;
    }
}
