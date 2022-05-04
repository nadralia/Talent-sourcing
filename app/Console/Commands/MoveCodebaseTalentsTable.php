<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MoveCodebaseTalentsTable extends Command
{
    protected $signature = 'talentsourcing:move-codebase_talents-data
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Move codebase talents from the old DB into the new DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating codebase talents data');

        $old_codebase_talents = DB::connection('base_app_old')->table('codebase_talents');

        $migrated_codebase_talents = DB::table('codebase_talents')
            ->join('talents', 'talents.id', 'codebase_talents.talent_id')
            ->join('codebases', 'codebases.id', 'codebase_talents.codebase_id');

        if ($migrated_codebase_talents && ! $this->option('overwrite')) {
            $old_codebase_talents
                ->whereNotIn('codebase_id', $migrated_codebase_talents->pluck('codebase_id'))
                ->whereNotIn('talent_id', $migrated_codebase_talents->pluck('talent_id'));
        }

        $old_codebase_talents = $old_codebase_talents->get();

        if (! $old_codebase_talents->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_codebase_talents->count());

        $old_codebase_talents->each(function ($codebase_talent) {
            $this->output->progressAdvance();

            DB::table('codebase_talents')->updateOrInsert(
                [
                    'codebase_id' => $codebase_talent->codebase_id,
                    'admin_id'    => $codebase_talent->user_id,
                    'talent_id'   => $codebase_talent->talent_id,
                    'score'       => (int) $codebase_talent->score,
                    'created_at'  => $codebase_talent->created,
                    'updated_at'  => $codebase_talent->updated,
                ],
            );
        });

        $this->output->progressFinish();

        $this->info('Done migrating codebase talents data');
        $this->line('');

        return Command::SUCCESS;
    }
}
