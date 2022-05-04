<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MoveTalentsCoverLettersToTable extends Command
{
    protected $signature   = 'talentsourcing:move-coverletters-data';
    protected $description = 'Move talent cover letters from the old DB into the new DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating talents cover_letter data');

        $migrated_cover_letters = DB::table('cover_letters')->pluck('talent_id');

        $old_talents = DB::connection('base_app_old')->table('talents')->whereNotNull('cover_letter');

        if ($migrated_cover_letters) {
            $old_talents->whereNotIn('id', $migrated_cover_letters);
        }

        $old_talents = $old_talents->get(['id', 'cover_letter']);

        if (! $old_talents->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_talents->count());

        $old_talents->each(function ($talent) use ($migrated_cover_letters) {
            if ($migrated_cover_letters->contains($talent->id)) {
                $this->line("Resume for talent id {$talent->id} already exists. Skipping");
                return;
            }
            
            $this->output->progressAdvance();

            DB::table('cover_letters')->updateOrInsert(
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
            'name'              => $talent->cover_letter,
            'file_name'         => $talent->cover_letter,
            'created_at'        => $now,
            'updated_at'        => $now,

        ];
    }
}
