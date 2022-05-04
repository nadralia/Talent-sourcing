<?php

return [
    'max_primary_skills'   => env('RESUME_MAX_PRIMARY_SKILLS', 4),
    'max_secondary_skills' => env('RESUME_MAX_SECONDARY_SKILLS', 4),

    'parsing_apis' => [
        'lever' => env('LEVER_PARSING_API', 'https://jobs.lever.co/parseResume'),
    ],

    'cache_days' => env('RESUME_CACHE_DAYS', 30),
    
    'talent_data_cache_prefix'      => env('TALENT_DATA_CACHE_PREFIX', 'talent_data_'),
    'skills_data_cache_prefix'      => env('SKILLS_DATA_CACHE_PREFIX', 'skills_data_'),
    'tools_data_cache_prefix'       => env('TOOLS_DATA_CACHE_PREFIX', 'tools_data_'),
    'educations_data_cache_prefix'  => env('EDUCATIONS_DATA_CACHE_PREFIX', 'educations_data_'),
    'experiences_data_cache_prefix' => env('EXPERIENCES_DATA_CACHE_PREFIX', 'experiences_data_'),
];
