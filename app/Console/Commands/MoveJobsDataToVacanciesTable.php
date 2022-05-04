<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MoveJobsDataToVacanciesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'talentsourcing:move-jobs-table
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Move data from the "jobs" table in the old DB into the "vacancies" table in the new DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating jobs into vacancies');
            
        $migrated_vacancies = DB::table('vacancies')->pluck('id');

        $old_jobs = DB::connection('base_app_old')->table('jobs')
            ->join('clients', 'clients.id', 'jobs.client_id')
            ->leftJoin('locations', 'locations.id', 'jobs.location_id')
            ->selectRaw('jobs.*, locations.id AS location_id');

        if ($migrated_vacancies && ! $this->option('overwrite')) {
            $old_jobs->whereNotIn('jobs.id', $migrated_vacancies);
        }

        $old_jobs = $old_jobs->get();

        if (! $old_jobs->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_jobs->count());

        $old_jobs->each(function ($job) {
            $this->output->progressAdvance();

            DB::table('vacancies')->updateOrInsert(
                [ 'id' => $job->id ],
                $this->transformData($job)
            );
        });

        $this->output->progressFinish();

        $this->info('Done migrating jobs data');
        $this->line('');

        return Command::SUCCESS;
    }

    /**
     * Transform the old job record to the new format
     *
     * @param mixed $job
     *
     * @return  array
     */
    public function transformData($job)
    {
        $now = now();

        $salary     = explode(' - ', $job->salary);
        $min_salary = count($salary) ? (int) $salary[0] : null;
        $max_salary = count($salary) > 1 ? (int) $salary[1] : null;

        $degrees_map = [
            1 => 2,
            2 => 3,
            4 => 4,
        ];

        return [
            'id'                 => $job->id,
            'business_id'        => $job->client_id,
            'title'              => $job->title,
            'description'        => $job->description,
            'country_id'         => 'CA',
            'state_id'           => $job->location_id == 5 ? 1 : $job->location_id ?? 1,  // Apprently, there's a location called "remote"
            'seniority_id'       => 2,
            'degree_id'          => $degrees_map[$job->education],
            'remote_type_id'     => 1,
            'min_salary'         => $min_salary,
            'max_salary'         => $max_salary,
            'min_years'          => $job->year_experience,
            'max_years'          => $job->year_experience,
            'featured'           => $job->featured,
            'vetting_score'      => null,
            'video_instructions' => null,
            'created_at'         => $now,
            'updated_at'         => $now,
        ];
    }
}
