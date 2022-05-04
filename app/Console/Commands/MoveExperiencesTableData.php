<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Talent;
use App\Models\State;

class MoveExperiencesTableData extends Command
{
    protected $signature = 'talentsourcing:move-experiences-table
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Move talent experiences from the old DB into the new DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating experiences data');

        $migrated_experiences = DB::table('experiences')->pluck('id');

        $old_experiences = DB::connection('base_app_old')->table('experiences')
            ->join('talents', 'talents.id', 'experiences.talent_id')
            ->selectRaw('experiences.*, talents.id AS talent_id');

        if ($migrated_experiences && ! $this->option('overwrite')) {
            $old_experiences->whereNotIn('experiences.id', $migrated_experiences);
        }

        $old_experiences = $old_experiences->get();

        if (! $old_experiences->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_experiences->count());

        $old_experiences->each(function ($experience) {
            $this->output->progressAdvance();

            $talent_country = Talent::whereId($experience->talent_id)->first()?->country_id ?? 'CA';
            $talent_state   = State::enabled()->whereCountryId($talent_country)->inRandomOrder()->first()?->id ?? 71061;

            DB::table('experiences')->updateOrInsert(
                [ 'id' => $experience->id ],
                [
                    'talent_id'    => $experience->talent_id,
                    'company_name' => $experience->company_name,
                    'state_id'     => $talent_state,
                    'country_id'   => $talent_country,
                    'seniority_id' => 1,
                    'title_id'     => $experience->title_id ?? 1,
                    'description'  => $experience->description,
                    'industry_id'  => $experience->industry_id,
                    'start_date'   => $experience->start_date . '-01',
                    'end_date'     => $experience->end_date ? $experience->end_date . '-01' : null,
                    'created_at'   => $experience->created ?? now(),
                    'updated_at'   => $experience->updated ?? now(),
                ]
            );
        });

        $this->output->progressFinish();

        $this->info('Done migrating experiences data');
        $this->line('');

        return Command::SUCCESS;
    }
}
