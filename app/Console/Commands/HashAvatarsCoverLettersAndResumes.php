<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HashAvatarsCoverLettersAndResumes extends Command
{
    protected $signature = 'talentsourcing:hash-talents-files
                            {--overwrite : Shall we overwrite current that with newly imported data?}
                            ';
    protected $description = 'Hash talent resume, avatar and cover letter file names and DB entry names';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        collect([
            'resumes' => [
                'folder_name' => 'resumes',
                'column_name' => 'file_name',
            ],
            'cover_letters' => [
                'folder_name' => 'cover_letters',
                'column_name' => 'file_name',
            ],
            'talents' => [
                'folder_name' => 'avatars',
                'column_name' => 'avatar',
            ]
        ])->each(function ($data, $table_name) {
            $this->hashAndStoreTableRecord($table_name, $data['column_name'], $data['folder_name']);
        });

        return Command::SUCCESS;
    }

    private function hashAndStoreTableRecord($table, $column_name, $folder_name): void
    {
        $table_records = DB::table($table)->whereNotNull($column_name)->get(['id', $column_name]);

        $this->line("Hashing $table data...");

        $this->output->progressStart($table_records->count());
        
        $table_records->each(function ($record) use ($table, $column_name, $folder_name) {
            if ($file_hash = $this->getFileHash("$folder_name/{$record->$column_name}")) {
                $extension = $this->getFileExtension($record->$column_name);
    
                $new_file_name = $this->getNewFileName($file_hash, $extension);
    
                if (Storage::exists("$folder_name/$new_file_name") && ! $this->option('overwrite')) {
                    return;
                }

                $this->updateDatabaseRecord($table, $record->id, $column_name, $new_file_name);
    
                $this->renameFileInStorage("$folder_name/{$record->$column_name}", "$folder_name/$new_file_name");
    
                $this->output->progressAdvance();
            }
        });
        $this->output->progressFinish();
    }

    private function getFileHash($file_path): string|bool
    {
        if (! Storage::exists($file_path)) {
            return false;
        }

        return md5(Storage::get($file_path));
    }

    private function getFileExtension($file_name): string
    {
        return explode('.', $file_name)[1];
    }

    private function getNewFileName($hash, $extension): string
    {
        return "$hash.$extension";
    }

    private function updateDatabaseRecord($table, $id, $column, $new_file_name): int
    {
        return DB::table($table)->where('id', $id)->update([$column => $new_file_name]);
    }

    public function renameFileInStorage($old_path, $new_path): bool
    {
        if (Storage::exists($new_path)) {
            return true;
        }

        return Storage::move($old_path, $new_path);
    }
}
