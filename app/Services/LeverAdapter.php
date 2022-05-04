<?php

namespace App\Services;

use App\Interfaces\ResumeParser;
use App\Models\Degree;
use App\Models\Seniority;
use App\Models\Skill;
use App\Models\Tool;
use App\Models\Title;
use App\Models\SkillLevel;

class LeverAdapter implements ResumeParser
{
    protected $resumeService;
    protected $skill_levels;
    protected $max_primary;
    protected $max_secondary;

    public function __construct()
    {
        $this->resumeService = new ResumeService;

        $this->max_primary   = config('resume.max_primary_skills');
        $this->max_secondary = config('resume.max_secondary_skills');
    }

    /**
     * Parse a talent's resume
     *
     * @param int   $talent_id Primary key of the talent who owns this resume
     * @param array $resume    Resume data output from parsing API
     *
     *
     * @return array|null
     */
    public function parseResume(int $talent_id, array $resume_data = null) : ?array
    {
        $talent_data = [];

        [ $talent_data['first_name'], $talent_data['last_name'] ] = explode(' ', $resume_data['names'][0]);

        if (isset($resume_data['phones'])) {
            $talent_data['phone'] = (int) filter_var($resume_data['phones'][0]['value'], FILTER_SANITIZE_NUMBER_INT);
        }

        if (isset($resume_data['links'])) {
            foreach ($resume_data['links'] as $link) {
                if (strpos($link['url'], 'linkedin.com') !== false) {
                    $talent_data['linkedin'] = $link['url'];
                } elseif (strpos($link['url'], 'github.com') !== false) {
                    $talent_data['github'] = $link['url'];
                } elseif (strpos($link['url'], 'twitter.com') !== false) {
                    $talent_data['twitter'] = $link['url'];
                } else {
                    $talent_data['website'] = $link['url'];
                }
            }
        }

        if (isset($resume_data['location']['address']['CountryCode'])) {
            $talent_data['country_id'] = $talent_data['nationality'] = $resume_data['location']['address']['CountryCode'];
        }

        if (isset($resume_data['schools'])) {
            $talent_data['educations'] = $this->extractEducationData($resume_data['schools']);
        }

        if (isset($resume_data['summary']['skills'])) {
            $talent_data['skills'] = $this->extractSkillsData($resume_data['summary']['skills']);
            $talent_data['tools']  = $this->extractToolsData($resume_data['summary']['skills']);
        }

        if (isset($resume_data['positions'])) {
            $talent_data['experiences'] = $this->extractExperienceData($resume_data['positions']);
        }

        $talent_data['id'] = $talent_id;

        return array_filter($talent_data);
    }

    /**
     * Extract education data from resume data
     *
     * @param array $data Resume data output from parsing API
     *
     *
     * @return array|null
     */
    public function extractEducationData(array $data) : ?array
    {
        foreach ($data as $key => $school) {
            if (isset($school['start_date'])) {
                $education['start_date'] = "{$school['start']['year']}-" . str_pad($school['start']['month'], 2, '0', STR_PAD_LEFT) . "-01" ?? null;
            } else {
                $education['start_date'] = null;
            }

            if (isset($school['end'])) {
                $education['end_date'] = "{$school['end']['year']}-" . str_pad($school['end']['month'], 2, '0', STR_PAD_LEFT) . "-01" ?? null;
            } else {
                $education['end_date'] = null;
            }

            $education['id']          = null;
            $education['key']         = $key;
            $education['enabled']     = true;
            $education['institution'] = $school['org'] ?? null;
            $education['title']       = $school['degree'] ?? null;
            $education['degree_id']   = $this->resumeService->guessDegree($school['degree']) ?? 2;
            $education['degree']      = Degree::whereId($education['degree_id'])->first()?->name;

            $return[] = $education;
        }

        return $return ?? null;
    }

    /**
     * Extract skill data from resume data
     *
     * @param string $data CSV of skills from resume data
     *
     *
     * @return array|null
     */
    public function extractSkillsData(string $data) : ?array
    {
        $skills = explode(', ', $data);

        foreach ($skills as $key => $skill) {
            $explode = explode(' ', $skill);

            if (count($explode) > 1) {
                $skills = array_merge($skills, $explode);
                unset($skills[$key]);
            }
        }

        $skill_count = 0;

        return array_filter(Skill::whereIn('name', array_unique($skills))->pluck('id')->map(function ($skill) use (&$skill_count) {
            $skill_count++;

            if ($skill_count <= ($this->max_primary + $this->max_secondary)) {
                return [
                    'id'             => null,
                    'key'            => ($skill_count - 1),
                    'enabled'        => true,
                    'skill_id'       => $skill,
                    'skill_level_id' => SkillLevel::EXPERIENCED,
                    'is_primary'     => false,
                    'is_secondary'   => true,
                    'start_date'     => now()->subYear()->format('Y-m') . '-01',
                    'end_date'       => null,
                ];
            }
        })->toArray());
    }

    /**
     * Extract tools data from resume data
     *
     * @param string $skill_data CSV of skills from resume data
     *
     *
     * @return array|null
     */
    public function extractToolsData(string $data) : ?array
    {
        $skills = explode(', ', $data);

        foreach ($skills as $key => $skill) {
            $explode = explode(' ', $skill);

            if (count($explode) > 1) {
                $skills = array_merge($skills, $explode);
                unset($skills[$key]);
            }
        }

        return Tool::whereIn('name', array_unique($skills))->pluck('id')->toArray();
    }

    /**
     * Extract experience data from resume data
     *
     * @param array $data Experience data output from parsing API
     *
     *
     * @return array|null
     */
    public function extractExperienceData(array $data) : ?array
    {
        $skip_words = [
            Seniority::JUNIOR       => 'junior',
            Seniority::SENIOR       => 'senior',
            Seniority::INTERMEDIATE => 'intermediate',
            Seniority::MANAGER      => 'manager',
            Seniority::DIRECTOR     => 'director',
            Seniority::EXECUTIVE    => 'executive',
        ];

        $title_names = collect($data)->map(function ($position) use ($skip_words) {
            return trim(str_replace($skip_words, '', strtolower($position['title'])));
        })->toArray();
        
        $title_ids = Title::whereIn('name', $title_names)->pluck('name', 'id')->map(function ($title) {
            return strtolower($title);
        })->toArray();

        $seniorities = Seniority::pluck('name', 'id')->toArray();
        $titles      = Title::pluck('name', 'id')->toArray();

        foreach ($data as $key => $position) {
            $title_id     = null;
            $seniority_id = null;

            $lower_case_title = strtolower($position['title']);

            foreach ($title_ids as $id => $keyword) {
                if (str_replace($keyword, '', $lower_case_title) !== $lower_case_title) {
                    $title_id = $id;
                }
            }

            foreach ($skip_words as $id => $title) {
                if (str_replace($title, '', $lower_case_title) !== $lower_case_title) {
                    $seniority_id = $id;
                }
            }

            $experience['id']           = null;
            $experience['key']          = $key;
            $experience['enabled']      = 1;
            $experience['company_name'] = $position['org'];
            $experience['description']  = $position['summary'];
            $experience['seniority_id'] = $seniority_id ?? null;
            $experience['seniority']    = $seniority_id ? $seniorities[$seniority_id] : null;
            $experience['title_id']     = $title_id ?? null;
            $experience['title']        = $title_id ? $titles[$title_id] : null;
            $experience['industry_id']  = null;
            $experience['industry']     = null;

            if (isset($position['start_date'])) {
                $experience['start_date'] = "{$position['start']['year']}-" . str_pad($position['start']['month'], 2, '0', STR_PAD_LEFT) . "-01";
            } else {
                $experience['start_date'] = null;
            }

            if (isset($position['end'])) {
                $experience['end_date'] = "{$position['end']['year']}-" . str_pad($position['end']['month'], 2, '0', STR_PAD_LEFT) . "-01";
            } else {
                $experience['end_date'] = null;
            }

            $experience['state_id']   = null;
            $experience['state']      = null;
            $experience['country_id'] = null;
            $experience['country']    = null;

            $return[] = $experience;
        }

        return $return ?? null;
    }
}
