<?php

namespace App\Services;

use App\Models\Talent;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use DOMDocument;
use Illuminate\Support\Facades\Log;

class LeverService
{
    protected $url;

    /**
     * TalentService constructor.
     *
     * @param Talent $talent
     */
    public function __construct(protected string $resume_file_path)
    {
        $this->url = config('resume.parsing_apis')['lever'];
    }

    /**
     * Parse a talent's resume
     *
     * @param mixed $resume Resume file
     * 
     * 
     * @return array|null
     */
    public function readResume() : ?array
    {
        try {
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTMLFile($this->getRandomLeverDemoApplyUrl());
            libxml_use_internal_errors(false);

            $csrf       = $dom->getElementById('csrf-token')->getAttribute('value');
            $posting_id = $dom->getElementById('posting-id')->getAttribute('value');

            $resume_file = Storage::get($this->resume_file_path);
            $file_name = substr($this->resume_file_path, strrpos($this->resume_file_path, '/') + 1);

            $response = Http::withHeaders([ 'Referer' => 'https://jobs.lever.co/', 'Origin' => 'https://jobs.lever.co/' ])
                ->attach('resume', $resume_file, $file_name)
                ->post($this->url, [ 'resume' => $file_name, 'csrf' => $csrf, 'postingId' => $posting_id ])
                ->throw();

            if ($response->status() == 200) {
                return $response->json();
            }
        } catch (\Throwable $throwable) {
            Log::error($throwable);
        }

        return null;
    }

    /**
     * Get a random job posting url from Lever
     *
     *
     * @return string|null
     */
    public function getRandomLeverDemoApplyUrl() : ?string
    {
        $random_int = random_int(1, 350);

        return Http::get("https://api.lever.co/v0/postings/leverdemo?skip={$random_int}&limit=1&mode=json")
            ->throw()
            ->json()[0]['applyUrl'];
    }
}
