<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class MoveTalentFiles extends Command
{
    protected $signature   = 'talentsourcing:move-talents-files';
    protected $description = 'Move talent avatars, resumes and cover letters (files) into Laravel storage';

    /**
     * Source directory of asset files.
     *
     * @var string
     */
    const SOURCE_DIR = '/var/www/html/webroot/uploads/files';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating talents resume, avatar and cover_letter files');

        $old_asset_directories = $this->getListOfDirectoryContents(config('app.old_files_path'));

        $this->output->progressStart($old_asset_directories->count());

        $old_asset_directories->each(function ($dir) {
            $directory_contents = $this->getListOfDirectoryContents($dir);

            $directory_contents->each(function ($file_path) {
                $this->moveTalentFileToAppropriateDirectory($file_path);
            });
            
            $this->output->progressAdvance();
        });
        
        $this->output->progressFinish();

        $this->info('Done migrating talent files');
        $this->line('');

        return Command::SUCCESS;
    }

    /**
     * Copy talent's file from old project to appropriate storage path in new folder
     *
     * @param string $file_path
     *
     * @return bool
     */
    private function moveTalentFileToAppropriateDirectory($file_path): bool
    {
        $file_name = $this->extractDirectoryOrFileNameFromPath($file_path);

        if ($extracted_directory_name = $this->getDirectoryNameFromFile($file_name)) {
            Storage::makeDirectory($extracted_directory_name);

            $destination_file_path = Storage::path($extracted_directory_name) .'/'. $file_name;

            return copy($file_path, $destination_file_path);
        }

        return false;
    }

    /**
     * Given a path, it returns a collection containing the absolute paths of all directories or files in that path
     *
     * @param string $path
     *
     * @return Illuminate\Support\Collection
     */
    private function getListOfDirectoryContents($path): Collection
    {
        if (! file_exists($path)) {
            throw new Exception("The provided directory does not exist: $path");
        }

        return collect(glob($path.'/*'));
    }

    /**
     * Given a path, it returns the directory or filename of that path
     *
     * @param string $path
     *
     * @return string
     */
    private function extractDirectoryOrFileNameFromPath($path): string
    {
        $path_sections = explode('/', $path);

        return $path_sections[count($path_sections) - 1];
    }

    /**
     * Extract directory name from a file_name.
     * e.g. get 'resumes' from 'resume__10.pdf'
     *
     * @param string $file_name
     *
     * @return mixed string|bool
     */
    private function getDirectoryNameFromFile($file_name): string|bool
    {
        $name_sections = explode('__', $file_name);

        if (count($name_sections) < 2) {
            return false;
        }
        
        // eg turn 'resume' to 'resumes'
        return "{$name_sections[0]}s";
    }
}
