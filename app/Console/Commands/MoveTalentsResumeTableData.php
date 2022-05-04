<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MoveTalentsResumeTableData extends Command
{
    protected $signature = 'talentsourcing:move-resume-data
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Nove talents resumes from the old DB into the new DB';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating talents resume data');
            
        $migrated_resumes = DB::table('resumes')->pluck('talent_id');

        $old_talents = DB::connection('base_app_old')->table('talents')->whereNotNull('resume');

        if ($migrated_resumes && ! $this->option('overwrite')) {
            $old_talents->whereNotIn('id', $migrated_resumes);
        }

        $old_talents = $old_talents->get([ 'id', 'resume' ]);

        if (! $old_talents->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_talents->count());

        $old_talents->each(function ($talent) {
            $this->output->progressAdvance();

            DB::table('resumes')->updateOrInsert(
                [ 'talent_id' => $talent->id ],
                $this->transformData($talent)
            );
        });

        $this->output->progressFinish();

        $this->info('Done migrating talents resume data');
        $this->line('');

        return Command::SUCCESS;
    }

    /**
     * Transform the old talent record to the new format
     *
     * @param mixed $talent
     *
     * @return  array
     */
    public function transformData($talent)
    {
        $now = now();

        return [
            'talent_id'         => $talent->id,
            'name'              => $talent->resume,
            'file_name'         => $talent->resume,
            'created_at'        => $now,
            'updated_at'        => $now,
        ];
    }
}
