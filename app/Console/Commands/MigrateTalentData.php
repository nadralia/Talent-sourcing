<?php

namespace App\Console\Commands;

use App\Models\TalentData;
use App\Models\TalentLanguage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MigrateTalentData extends Command
{
    protected $signature = 'talentsourcing:migrate-talents-data
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Move talents data from the old DB into the new DB';

    protected $english_countries = [
        'NG', 'US', 'CA', 'UK',
    ];
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating talents data');

        $migrated_talents = DB::table('talents')->pluck('id');

        $old_talents = DB::connection('base_app_old')->table('talents')
            ->leftJoin('countries', 'countries.id', 'talents.citizenship')
            ->leftJoin('countries AS C', 'C.id', 'talents.location')
            ->leftJoin('titles', 'titles.id', 'talents.title_id')
            ->leftJoin('talents AS ref', 'talents.ref_code', 'ref.referral')
            ->leftJoin('users', 'users.id', 'talents.admin_created')
            ->selectRaw('talents.*, users.id AS admin_created, ref.id AS referrer')
            ->selectRaw('UPPER(countries.abbr) AS nationality')
            ->selectRaw('UPPER(C.abbr) AS country_id')
            ->selectRaw('titles.id AS title_id');

        if ($migrated_talents && ! $this->option('overwrite')) {
            $old_talents->whereNotIn('talents.id', $migrated_talents);
        }

        $old_talents = $old_talents->get();

        if (! $old_talents->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_talents->count());

        $referrers = DB::connection('base_app_old')->table('talents')
            ->join('talents AS T', 'T.ref_code', 'talents.referral')
            ->whereNotNull('talents.referral')
            ->selectRaw('T.id, talents.referral')
            ->pluck('id', 'referral')
            ->toArray();

        $country_currencies = DB::table('countries')->pluck('currency_id', 'id');

        $old_talents->each(function ($talent) use ($referrers, $country_currencies) {
            $this->output->progressAdvance();

            $name       = explode(' ', $talent->name);
            $last_name  = array_pop($name);
            $first_name = implode(' ', $name);

            $invalid_countries = [
                'YU' => 'CA',
                ''   => 'CA',
            ];

            $nationality = isset($invalid_countries[$talent->nationality]) ? $invalid_countries[$talent->nationality] : $talent->nationality;
            $country     = isset($invalid_countries[$talent->country_id]) ? $invalid_countries[$talent->country_id] : $talent->country_id;
            $referrer_id = $referrers[$talent->referral] ?? null;

            $salary_currency_id = $country_currencies[$country] ?? null;

            DB::table('talents')->updateOrInsert(
                [ 'id' => $talent->id ],
                [
                    'first_name'         => $first_name,
                    'last_name'          => $last_name,
                    'email'              => $talent->email ?? "null-{$talent->id}",
                    'password'           => Hash::make($password = substr(md5($talent->email), 0, 8)),
                    'avatar'             => $talent->avatar,
                    'title_id'           => $talent->title_id ?? 32,
                    'title_start_date'   => now()->subYear()->startOfYear(),
                    'phone'              => (int) $talent->phone_number,
                    'linkedin'           => $talent->linkedin,
                    'github'             => $talent->github,
                    'twitter'            => $talent->twitter_url,
                    'website'            => $talent->portfolio_url,
                    'nationality'        => $nationality,
                    'country_id'         => $country,
                    'address'            => $talent->address,
                    'gender_id'          => $talent->gender_id ?? null,
                    'enabled'            => $talent->active == 0 ? 0 : 1,
                    'referral_code'      => $talent->ref_code,
                    'referrer_id'        => $referrer_id,
                    'admin_id'           => $talent->admin_created ?? 2,
                    'do_not_contact'     => $talent->do_not_contact == 1 ? 0 : 1,
                    'notice_period_id'   => 1,
                    'job_status_id'      => 1,
                    'remote_type_id'     => 1,
                    'salary_currency_id' => $salary_currency_id,
                    'created_at'         => $talent->created ?? now(),
                    'updated_at'         => $talent->modified ?? now(),
                ]
            );

            TalentData::updateOrCreate([ 'talent_id' => $talent->id, 'name' => 'password', 'value' => $password ]);

            if (in_array($country, $this->english_countries) || in_array($nationality, $this->english_countries)) {
                TalentLanguage::updateOrCreate(
                    [ 'talent_id' => $talent->id ],
                    [ 'language_id' => 'EN', 'language_level_id' => 2 ]
                );
            }
        });

        $this->output->progressFinish();

        $this->info('Done migrating talents data');
        $this->line('');

        return Command::SUCCESS;
    }
}
