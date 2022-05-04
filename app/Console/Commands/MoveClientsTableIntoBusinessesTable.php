<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MoveClientsTableIntoBusinessesTable extends Command
{
    protected $signature = 'talentsourcing:move-clients-into-businesses
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Move clients from the old DB into the new DB as businesses';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating businesses data');

        $migrated_businesses = DB::table('businesses')->pluck('id');

        $old_businesses = DB::connection('base_app_old')->table('clients')
            ->leftJoin('countries', 'countries.id', 'clients.country_id')
            ->leftJoin('industries', 'industries.id', 'clients.industry_id')
            ->selectRaw('clients.*')
            ->selectRaw('countries.abbr AS country_id')
            ->selectRaw('industries.id AS industry_id');
        
        if ($migrated_businesses && ! $this->option('overwrite')) {
            $old_businesses->whereNotIn('clients.id', $migrated_businesses);
        }
        
        $old_businesses = $old_businesses->get();

        $this->output->progressStart($old_businesses->count());

        $old_businesses->each(function ($business) {
            $this->output->progressAdvance();

            try {
                DB::table('businesses')->updateOrInsert(
                    [ 'id' => $business->id ],
                    [
                        'id'          => $business->id,
                        'name'        => $business->name,
                        'email'       => $business->email,
                        'size'        => $business->size,
                        'password'    => Hash::make($business->email),
                        'phone'       => (int) $business->phone_number,
                        'country_id'  => $business->country_id ?? 'CA',
                        'industry_id' => $business->industry_id ?? 31,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]
                );
            } catch (\Exception $e) {
                $this->error("Error migrating business id {$business->id}");
                $this->error($e->getMessage());
            }
        });

        $this->output->progressFinish();

        $this->info('Done migrating businesses data');
        $this->line('');    

        return Command::SUCCESS;
    }
}
