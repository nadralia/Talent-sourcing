<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MoveSkillsTable extends Command
{
    protected $signature = 'talentsourcing:move-skills-table
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Move skills table from the old DB into the new DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating skills data');

        $migrated_skills = DB::table('skills')->pluck('id');

        $old_skills = DB::connection('base_app_old')->table('skills');

        if ($migrated_skills && ! $this->option('overwrite')) {
            $old_skills->whereNotIn('id', $migrated_skills);
        }

        $old_skills = $old_skills->get();

        if (! $old_skills->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_skills->count());

        $old_skills->each(function ($skill) {
            $this->output->progressAdvance();

            DB::table('skills')->updateOrInsert(
                [ 'id' => $skill->id ],
                [
                    'id'         => $skill->id,
                    'name'       => $skill->title,
                    'enabled'    => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        });

        $this->output->progressFinish();

        $this->info('Done migrating skills data');
        $this->line('');

        return Command::SUCCESS;
    }
}
