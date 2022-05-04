<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateOldDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'talentsourcing:migrate-old-data
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Runs all commands to migrate old data into the new database, in the right order';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->comment('Migrating old data...');
        $this->line('');

        $commnd_list = [
            [ 'talentsourcing:move-skills-table', $this->option('overwrite') ],
            [ 'talentsourcing:move-codebases-table', null ],
            [ 'talentsourcing:migrate-users-data', $this->option('overwrite') ],
            [ 'talentsourcing:migrate-talents-data', $this->option('overwrite') ],
            [ 'talentsourcing:move-experiences-table', $this->option('overwrite') ],
            [ 'talentsourcing:move-resume-data', $this->option('overwrite') ],
            [ 'talentsourcing:move-coverletters-data', null ],
            [ 'talentsourcing:move-talents-files', null ],
            [ 'talentsourcing:move-talent_skills-data', $this->option('overwrite') ],
            [ 'talentsourcing:move-clients-into-businesses', $this->option('overwrite') ],
            [ 'talentsourcing:move-talent_vettings-data', $this->option('overwrite') ],
            [ 'talentsourcing:move-jobs-table', $this->option('overwrite') ],
            [ 'talentsourcing:hash-talents-files', $this->option('overwrite') ],
            [ 'talentsourcing:move-experiences_skills-table', $this->option('overwrite') ],
            [ 'talentsourcing:move-educations-table', $this->option('overwrite') ],
            [ 'talentsourcing:move-codebase_skills-data', null ],
            [ 'talentsourcing:move-vacancy-talents', $this->option('overwrite') ],
            [ 'talentsourcing:move-job-skills-data', $this->option('overwrite') ],
        ];

        foreach ($commnd_list as $command) {
            $overwrite = $command[1] ? [ '--overwrite' => true ] : [];
            $this->call($command[0], $overwrite);
        }

        $this->line('');
        $this->comment('Done migrating old data!');

        return Command::SUCCESS;
    }
}
