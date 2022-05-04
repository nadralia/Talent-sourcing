<?php

namespace App\Services;

use App\Models\Degree;

class ResumeService
{
    /**
     * Guess the degree_id from a title.
     * Eg. M.Sc in Computer Engineering should guess Degree::MASTER
     *
     * @param string $title Tile we want to guess degree from
     *
     *
     * @return integer|null
     */
    public function guessDegree(string $title) : ?int
    {
        $title = strtolower(str_replace('.', '', $title));

        $degree_map = [
            Degree::BACHELOR => [ 'bachelor ', 'bsc ' ,'btech ', 'b sc ', 'bed ', 'beng ', 'ba ', 'b a ', 'bs ', 'hnd ', 'hnd'  ],
            Degree::MASTER   => [ 'master ', 'msc ', 'mtech ' , 'm sc ', 'mba ', 'mba', 'med ', 'ms ', ],
        ];

        foreach ($degree_map as $degree_id => $keywords) {
            if (str_replace($keywords, '', $title) !== $title) {
                return $degree_id;
            }
        }

        return null;
    }
}
