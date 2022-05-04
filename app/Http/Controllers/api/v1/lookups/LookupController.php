<?php

namespace App\Http\Controllers\api\v1\lookups;

use App\Http\Resources\LookupResource;
use Illuminate\Support\Facades\Cache;

class LookupController
{
    protected $model_map;
    protected $model_parent_map;

    public function __construct()
    {
        $this->page_size = config('app.default_pagination_size');
        
        $this->model_map = [
            'industries'      => \App\Models\Industry::class,
            'degrees'         => \App\Models\Degree::class,
            'countries'       => \App\Models\Country::class,
            'countries'       => \App\Models\Country::class,
            'currencies'      => \App\Models\Currency::class,
            'genders'         => \App\Models\Gender::class,
            'tools'           => \App\Models\Tool::class,
            'skills'          => \App\Models\Skill::class,
            'skill-levels'    => \App\Models\SkillLevel::class,
            'languages'       => \App\Models\Language::class,
            'language-levels' => \App\Models\LanguageLevel::class,
            'job-statuses'    => \App\Models\JobStatus::class,
            'notice-periods'  => \App\Models\NoticePeriod::class,
            'remote-types'    => \App\Models\RemoteType::class,
            'states'          => \App\Models\State::class,
            'titles'          => \App\Models\Title::class,
            'seniorities'     => \App\Models\Seniority::class,
            'culture-fit'     => \App\Models\CultureFit::class,

            'culture-fit-categories' => \App\Models\CultureFitCategory::class,
        ];

        $this->model_parent_map = [
            'countries'   => 'country_id',
            'states'      => 'country_id',
            'culture-fit' => 'category_id',
        ];
    }

    /**
     * Return list of talents
     *
     *
     * @return \App\Http\Resources\TalentCollection
     */
    public function index(string $entity, mixed $entity_id = null, string $sub_entity = null)
    {
        if (! isset($this->model_map[$entity])) {
            return errorResponse('Lookup not found', 404);
        }

        if (($is_sub_entity = $entity_id && $sub_entity) && (! isset($this->model_parent_map[$sub_entity]))) {
            return errorResponse('Lookup not found', 404);
        }

        $cache_key = "lookup_{$entity}_{$entity_id}_{$sub_entity}";

        $data = Cache::remember($cache_key, now()->tomorrow()->endOfDay(), function () use ($entity, $entity_id, $sub_entity, $is_sub_entity) {
            $model = $this->model_map[$is_sub_entity ? $sub_entity : $entity]::query();

            if ($is_sub_entity) {
                $model->where($this->model_parent_map[$sub_entity], $entity_id);
            }

            if (auth('admin')->check()) {
                return $model->get();
            } else {
                return $model->enabled()->get();
            }
        });

        if  ($sub_entity == 'culture-fit' && $entity == 'culture-fit-categories') {
            $data = $data->map(function ($item) {
                $item->name = strtr($item->name, [ ' (M)' => '', ' (F)' => '' ]);

                return $item;
            });
        }

        return LookupResource::collection($data);
    }
}
