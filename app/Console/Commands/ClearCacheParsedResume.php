<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearCacheParsedResume extends Command
{
    protected $signature = 'talentsourcing:clear-cached-resume
                            {talent : Primary key of the talent of interest}
                            ';
    protected $description = 'Clears the cached resume data for the specified talent';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Cache::forget(config('resume.talent_data_cache_prefix') . $this->argument('talent'));
        Cache::forget(config('resume.skills_data_cache_prefix') . $this->argument('talent'));
        Cache::forget(config('resume.tools_data_cache_prefix') . $this->argument('talent'));
        Cache::forget(config('resume.educations_data_cache_prefix') . $this->argument('talent'));
        Cache::forget(config('resume.experiences_data_cache_prefix') . $this->argument('talent'));

        $this->info('Cleared cached resume data');
        $this->line('');

        return Command::SUCCESS;
    }
}
