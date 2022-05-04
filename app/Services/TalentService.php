<?php

namespace App\Services;

use App\Models\Talent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TalentService
{
    protected $parsing_api;
    protected $leverAdapter;
    protected $talent_data_cache_key;
    protected $skills_data_cache_key;
    protected $educations_data_cache_key;
    protected $experiences_data_cache_key;

    /**
     * TalentService constructor.
     *
     * @param Talent $talent
     */
    public function __construct(protected Talent $talent)
    {
        $this->parsing_api = config('resume.parsing_api');
        
        $this->cache_duration = now()->addDays(config('resume.cache_days'))->endOfDay();

        $this->leverAdapter = new LeverAdapter;

        $this->talent_data_cache_key      = config('resume.talent_data_cache_prefix') . $talent->id;
        $this->skills_data_cache_key      = config('resume.skills_data_cache_prefix') . $talent->id;
        $this->tools_data_cache_key       = config('resume.tools_data_cache_prefix') . $talent->id;
        $this->educations_data_cache_key  = config('resume.educations_data_cache_prefix') . $talent->id;
        $this->experiences_data_cache_key = config('resume.experiences_data_cache_prefix') . $talent->id;
    }

    /**
     * Parse a talent's resume.
     * We also have the option to cache the resume after parsing.
     * Cache key = "resume_data_" + talent PK
     *
     * @param mixed $resume_path  Path to resume file
     * @param bool  $should_cache Should we cache the resume after parsing?
     *
     *
     * @return \App\Http\Resources\TalentResource|null
     */
    public function parseResume(string $resume_path = null, bool $should_cache = false)
    {
        if (! $talent_resume = $this->talent->resumes()?->latest()->first()) {
            return null;
        }

        try {
            $file_name_from_path = $resume_path ? substr($resume_path, strrpos($resume_path, '/') + 1) : null;

            $file_name = $file_name_from_path ?? $talent_resume->file_name;
            $file_path = $resume_path ?? "resumes/{$talent_resume->file_name}";

            if ($file_name) {
                $talent_data = $resume_data = $this->leverAdapter->parseResume($this->talent->id, (new LeverService($file_path))->readResume());

                if (! $should_cache) {
                    if (isset($talent_data['experiences'])) {
                        Cache::put($this->experiences_data_cache_key, $talent_data['experiences'], $this->cache_duration);
                        unset($talent_data['experiences']);
                    }
                    
                    if (isset($talent_data['educations'])) {
                        Cache::put($this->educations_data_cache_key, $talent_data['educations'], $this->cache_duration);
                        unset($talent_data['educations']);
                    }

                    if (isset($talent_data['skills'])) {
                        Cache::put($this->skills_data_cache_key, $talent_data['skills'], $this->cache_duration);
                        unset($talent_data['skills']);
                    }

                    if (isset($talent_data['tools'])) {
                        Cache::put($this->tools_data_cache_key, $talent_data['tools'], $this->cache_duration);
                        unset($talent_data['tools']);
                    }

                    Cache::put($this->talent_data_cache_key, $talent_data, $this->cache_duration);
                }

                return $resume_data;
            }
        } catch (\Throwable $throwable) {
            Log::error($throwable);
        }

        return null;
    }

    /**
     * Update a talent's educations.
     *
     * @param array $data Array of educations
     *
     *
     * @return String
     */
    public function updateEducations(array $data = null)
    {
        if ($data) {
            foreach ($data as $item) {
                $this->talent->educations()->whereId($item['id'])->update($item);
            }
        }
    }

    /**
     * Update a talent's experiences.
     *
     * @param array $data Array of experiences
     *
     *
     * @return String
     */
    public function updateExperiences(array $data = null)
    {
        if ($data) {
            foreach ($data as $item) {
                $this->talent->experiences()->whereId($item['id'])->update($item);
            }
        }
    }

    /**
     * Update a talent's languages.
     *
     * @param array $data Array of languages
     *
     *
     * @return String
     */
    public function updateLanguages(array $data = null)
    {
        if ($data) {
            foreach ($data as $item) {
                $this->talent->languages()->whereId($item['id'])->update($item);
            }
        }
    }

    /**
     * Update a talent's skills.
     *
     * @param array $data Array of skills
     *
     *
     * @return String
     */
    public function updateSkills(array $data = null)
    {
        if ($data) {
            foreach ($data as $item) {
                $this->talent->skills()->whereId($item['id'])->update($item);
            }
        }
    }

    /**
     * Update a talent's resumes.
     *
     * @param array $data Array of resumes
     *
     *
     * @return String
     */
    public function updateResumes(array $data = null)
    {
        if ($data) {
            foreach ($data as $item) {
                $this->talent->skills()->whereId($item['id'])->update($item);
            }
        }
    }

    /**
     * Deletes an item fro a telent's cached data
     *
     * @param integer $key  0-based index of the item to be deleted from cache
     * @param string  $type The type of data to be deleted (educations, skills, tools, experiences, talent)
     *
     *
     * @return bool
     */
    public function deleteCachedResumeData(int $key, string $type) : bool
    {
        $data_types = [
            'educations'  => 'hasCachedEducationData',
            'experiences' => 'hasCachedExperiencesData',
            'tools'       => 'hasCachedToolsData',
            'skills'      => 'hasCachedSkillsData',
            'talent'      => 'hasCachedData',
        ];

        $cache_key = $type.'_data_cache_key';

        if (is_integer($key) && auth('talent')->user()->{$data_types[$type]}) {
            $cached_data = Cache::get($this->{$cache_key});

            if (isset($cached_data[$key])) {
                unset($cached_data[$key]);

                return Cache::put($this->{$cache_key}, $cached_data, $this->cache_duration);
            } elseif ($type == 'talent') {
                return Cache::forget($this->{$cache_key});
            }
        }

        return false;
    }
}
