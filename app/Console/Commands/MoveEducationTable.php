<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MoveEducationTable extends Command
{
    protected $signature = 'talentsourcing:move-educations-table
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Move talent educations from the old DB into the new DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating educations data');

        $migrated_educations = DB::table('educations')->pluck('id');

        $old_educations = DB::connection('base_app_old')->table('educations')
            ->join('talents', 'talents.id', 'educations.talent_id')
            ->selectRaw('educations.*, talents.id as talent_id');

        if ($migrated_educations && ! $this->option('overwrite')) {
            $old_educations->whereNotIn('educations.id', $migrated_educations);
        }

        $old_educations = $old_educations->get();

        if (! $old_educations->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_educations->count());

        $degrees_map = [
            'Any / None'        => 1,
            'Associates'        => 2,
            "Bachelor's degree" => 3,
            'Masters degree'    => 4,
            'PHD'               => 5,
        ];

        $old_educations->each(function ($education) use ($degrees_map) {
            if ($degree_id = $degrees_map[$education->degree_type]) {
                DB::table('educations')->updateOrInsert(
                    [ 'id' => $education->id ],
                    [
                        'talent_id'   => $education->talent_id,
                        'degree_id'   => $degree_id,
                        'title'       => $education->title,
                        'institution' => $education->institution,
                        'start_date'  => $education->start_date ? Carbon::parse($education->start_date) : null,
                        'end_date'    => $education->end_date ? Carbon::parse($education->end_date) : null,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]
                );
    
                $this->output->progressAdvance();
            }
        });

        $this->output->progressFinish();

        $this->info('Done migrating educations data');
        $this->line('');

        return Command::SUCCESS;
    }
}
