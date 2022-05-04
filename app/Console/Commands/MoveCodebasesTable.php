<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MoveCodebasesTable extends Command
{
    protected $signature   = 'talentsourcing:move-codebases-table';
    protected $description = 'Move codebases table from the old DB into the new DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating codebases data');

        $migrated_codebases = DB::table('codebases')->pluck('id');

        $old_codebases = DB::connection('base_app_old')->table('codebase');

        if ($migrated_codebases) {
            $old_codebases->whereNotIn('id', $migrated_codebases);
        }

        $old_codebases = $old_codebases->get();

        if (! $old_codebases->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_codebases->count());

        $old_codebases->each(function ($codebase) {
            $this->output->progressAdvance();

            DB::table('codebases')->updateOrInsert(
                ['id' => $codebase->id],
                $this->transformData($codebase)
            );
        });

        $this->output->progressFinish();

        $this->info('Done migrating codebases data');
        $this->line('');

        return Command::SUCCESS;
    }


    /**
     * Transform the old codebase record to the new format
     *
     * @param mixed $codebase
     *
     * @return  array
     */
    public function transformData($codebase)
    {
        return [
            'id'         => $codebase->id,
            'title'      => $codebase->title,
            'url'        => $codebase->code,
            'source'     => $codebase->src,
            'enabled'    => true,
            'deleted_at' => null,
            'created_at' => $codebase->created ?? now(),
            'updated_at' => $codebase->created ?? now(),
        ];
    }
}
