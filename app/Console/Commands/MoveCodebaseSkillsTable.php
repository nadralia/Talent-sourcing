<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MoveCodebaseSkillsTable extends Command
{
    protected $signature   = 'talentsourcing:move-codebase_skills-data';
    protected $description = 'Move codebase skills from the old DB into the new DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating codebase skills data');
            
        $old_codebase_skills = DB::connection('base_app_old')->table('codebase_skills');

        $migrated_codebase_skills = DB::table('codebase_skills')
            ->join('skills', 'skills.id', 'codebase_skills.skill_id')
            ->join('codebases', 'codebases.id', 'codebase_skills.codebase_id')
            ->selectRaw('codebase_skills.*, skills.id AS skill_id, codebases.id AS codebase_id');

        if ($migrated_codebase_skills) {
            $old_codebase_skills
                ->whereNotIn('codebase_id', $migrated_codebase_skills->pluck('codebase_id'))
                ->whereNotIn('skill_id', $migrated_codebase_skills->pluck('skill_id'));
        }

        $old_codebase_skills = $old_codebase_skills->get();

        if (! $old_codebase_skills->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_codebase_skills->count());

        $old_codebase_skills->each(function ($codebase_skill) {
            $this->output->progressAdvance();

            DB::table('codebase_skills')->updateOrInsert(
                [ 
                    'codebase_id' => $codebase_skill->codebase_id,
                    'skill_id'    => $codebase_skill->skill_id
                ],
                [
                    'codebase_id' => $codebase_skill->codebase_id,
                    'skill_id'    => $codebase_skill->skill_id,
                    'created_at'  => $codebase_skill->created,
                    'updated_at'  => $codebase_skill->updated,
                ]
            );
        });

        $this->output->progressFinish();

        $this->info('Done migrating codebase skills data');

        return Command::SUCCESS;
    }
}
