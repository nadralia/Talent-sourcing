<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MoveUsersTableToAdminsTable extends Command
{
    protected $signature  = 'talentsourcing:migrate-users-data
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Move users from the old DB into the new DB as admins';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating users data to admins');

        $migrated_admins = DB::table('admins')->pluck('id');

        $old_users = DB::connection('base_app_old')->table('users');

        if ($migrated_admins && ! $this->option('overwrite')) {
            $old_users->whereNotIn('id', $migrated_admins);
        }

        $old_users = $old_users->get();

        if (! $old_users->count()) {
            $this->comment('No new data to migrate');
            $this->line('');

            return Command::SUCCESS;
        }

        $this->output->progressStart($old_users->count());

        $old_users->each(function ($user) {
            $this->output->progressAdvance();

            DB::table('admins')->updateOrInsert(
                [ 'id' => $user->id ],
                $this->transformData($user)
            );
        });

        $this->output->progressFinish();

        $this->info('Done migrating users data');
        $this->line('');

        return Command::SUCCESS;
    }

    /**
     * Transform the old user record to the new format
     *
     * @param mixed $user
     *
     * @return  array
     */
    public function transformData($user)
    {
        return [
            'id'                => $user->id,
            'name'              => $user->full_name,
            'email'             => $user->email,
            'password'          => $user->email,
            'enabled'           => $user->active,
            'deleted_at'        => null,
            'created_at'        => $user->created_at ?: now(),
            'updated_at'        => $user->created_at ?: now(),
        ];
    }
}
