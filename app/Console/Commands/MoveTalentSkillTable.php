<?php

namespace App\Console\Commands;

use App\Models\TalentSkill;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MoveTalentSkillTable extends Command
{
    protected $signature = 'talentsourcing:move-talent_skills-data
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Command Move talents skills from the old DB into the new DB';

    protected $max_primary_skills;
    protected $max_secondary_skills;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating talent skills data');
        $this->max_primary_skills   = config('resume.max_primary_skills', 4);
        $this->max_secondary_skills = config('resume.max_secondary_skills', 4);

        $migrated_talent_skills = DB::table('talent_skills')->get();

        $old_talent_skills = DB::connection('base_app_old')
            ->table('talents_skills')
            ->join('talents', 'talents.id', 'talents_skills.talent_id')
            ->leftJoin('skills', 'skills.id', 'talents_skills.skill_id')
            ->selectRaw('talents_skills.*, skills.id AS skill_id');

        if ($migrated_talent_skills && ! $this->option('overwrite')) {
            $old_talent_skills
                ->whereNotIn('skill_id', $migrated_talent_skills->pluck('skill_id'))
                ->whereNotIn('talent_id', $migrated_talent_skills->pluck('talent_id'));
        }

        $old_talent_skills = $old_talent_skills->get();

        if (! $old_talent_skills->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_talent_skills->count() * 2);

        $old_talent_skills->each(function ($talent_skill) {
            DB::table('talent_skills')->updateOrInsert(
                [ 'talent_id' => $talent_skill->talent_id, 'skill_id' => $talent_skill->skill_id ],
                [
                    'talent_id'      => $talent_skill->talent_id,
                    'skill_id'       => $talent_skill->skill_id,
                    'start_date'     => now()->subYear()->startOfYear(),
                    'skill_level_id' => 1,
                    'deleted_at'     => null,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]
            );

            $this->output->progressAdvance();
        });

        $this->pruneSkills();

        $this->output->progressFinish();

        $this->info('Done migrating talent kills data');
        $this->line('');

        return Command::SUCCESS;
    }

    private function pruneSkills()
    {
        $last_talent_id        = 0;
        $primary_skill_count   = 0;
        $secondary_skill_count = 0;

        TalentSkill::orderBy('talent_id')->get()->each(function ($talent_skill) use (&$last_talent_id, &$primary_skill_count, &$secondary_skill_count) {
            if ($last_talent_id != $talent_skill->talent_id) {
                $primary_skill_count   = 0;
                $secondary_skill_count = 0;
            }

            $is_primary   = $primary_skill_count < $this->max_primary_skills;
            $is_secondary = ! $is_primary;

            if ($secondary_skill_count < $this->max_secondary_skills) {
                $talent_skill->update([ 'is_primary' => $is_primary, 'is_secondary' => $is_secondary ]);
            }

            if ($primary_skill_count < $this->max_primary_skills) {
                $primary_skill_count++;
            } else {
                $secondary_skill_count++;
            }

            $last_talent_id = $talent_skill->talent_id;

            $this->output->progressAdvance();
        });

        DB::table('talent_skills')->whereNull('is_primary')->whereNull('is_secondary')->delete();
    }
}
