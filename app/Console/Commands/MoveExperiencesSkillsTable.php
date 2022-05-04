<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MoveExperiencesSkillsTable extends Command
{
    protected $signature = 'talentsourcing:move-experiences_skills-table
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Move talent experience skills from the old DB into talent_skills table the new DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating experiences skills data');

        $migrated_skills = DB::table('talent_skills')->get();

        $old_skills = DB::connection('base_app_old')->table('experiences_skills')
            ->join('experiences', 'experiences.id', 'experiences_skills.experience_id')
            ->leftJoin('skills', 'skills.id', 'experiences_skills.skill_id')
            ->selectRaw('experiences_skills.*')
            ->selectRaw('experiences.talent_id, skills.id AS skill_id');

        if ($migrated_skills && ! $this->option('overwrite')) {
            $old_skills
                ->whereNotIn('experiences_skills.skill_id', $migrated_skills->pluck('skill_id'))
                ->whereNotIn('experiences.talent_id', $migrated_skills->pluck('talent_id'));
        }

        $old_skills = $old_skills->get();

        if (! $old_skills->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_skills->count());

        $old_skills->each(function ($record) {
            $this->output->progressAdvance();

            DB::table('talent_skills')->updateOrInsert(
                [ 'talent_id' => $record->talent_id, 'skill_id' => $record->skill_id ],
                [
                    'talent_id'  => $record->talent_id,
                    'skill_id'   => $record->skill_id,
                    'start_date' => now()->subYear()->startOfYear(),
                    'created_at' => $record->created ?? now(),
                    'updated_at' => $record->updated ?? now(),
                ]
            );
        });

        $this->output->progressFinish();

        $this->info('Done migrating talent experience skills data');
        $this->line('');

        return Command::SUCCESS;
    }
}
