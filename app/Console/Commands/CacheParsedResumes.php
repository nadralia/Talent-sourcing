<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Resume;
use App\Services\LeverAdapter;
use App\Services\TalentService;

class CacheParsedResumes extends Command
{
    protected $signature = 'talentsourcing:parse-cache-resumes
                            {--overwrite : Shall we overwrite cache with new data?}
                            {talent?     : Execute only for the talent with this primary key}
                            ';
    protected $description = 'Goes through the DB and parses and caches talent resumes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(protected LeverAdapter $leverAdapter)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $intro_message = 'Parsing resume data';
        
        $single_talent_id = $this->argument('talent');

        if ($single_talent_id) {
            $intro_message .= " for talent {$single_talent_id}";
        }

        $this->info($intro_message);

        if ($single_talent_id) {
            $resumes = Resume::whereTalentId($single_talent_id);
        } else {
            $resumes = Resume::get();
        }
        
        $this->output->progressStart($resumes->count());

        $resumes->each(function ($resume) {
            (new TalentService($resume->talent))->parseResume(null, ! $this->option('overwrite'));
            $this->output->progressAdvance();
        });

        $this->output->progressFinish();

        $this->info('Done parsing and caching resume data');
        $this->line('');

        return Command::SUCCESS;
    }
}
