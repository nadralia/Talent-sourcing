<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MoveTalentVettingsTableData extends Command
{
    protected $signature = 'talentsourcing:move-talent_vettings-data
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Move talent vettings from the old DB into the new DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating talent vettings data');

        $migrated_talent_vettings = DB::table('talent_vettings')->pluck('id');

        $old_talent_vetting = DB::connection('base_app_old')->table('talents_vettings')
            ->join('talents', 'talents.id', 'talents_vettings.talent_id')
            ->selectRaw('talents_vettings.*, talents.id AS talent_id');

        if ($migrated_talent_vettings && ! $this->option('overwrite')) {
            $old_talent_vetting->whereNotIn('talents_vettings.id', $migrated_talent_vettings);
        }

        $old_talent_vetting = $old_talent_vetting->get();

        if (! $old_talent_vetting->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_talent_vetting->count());

        $old_talent_vetting->each(function ($tv) {
            $this->output->progressAdvance();

            DB::table('talent_vettings')->updateOrInsert(
                [ 'id' => $tv->id ],
                $this->transformData($tv)
            );
        });

        $this->output->progressFinish();

        $this->info('Done migrating talent vettings data');
        $this->line('');

        return Command::SUCCESS;
    }

    /**
     * Transform the old talent vetting record to the new table format
     *
     * @param mixed $talent
     *
     * @return  array
     */
    public function transformData($talent_vetting)
    {
        $now = now();

        return [
            'id'               => $talent_vetting->id,
            'talent_id'        => $talent_vetting->talent_id,
            'admin_id'         => $talent_vetting->user_id,
            'vetting_stage_id' => $talent_vetting->vetting,
            'internal_notes'   => $talent_vetting->comment,
            'created_at'       => $now,
            'updated_at'       => $now,
        ];
    }
}
