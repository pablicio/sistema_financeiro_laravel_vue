<?php namespace App\Interfaces;
use Illuminate\Database\Eloquent\Builder;

interface SearchableInterfaces {

    const
        CONDITION_LIKE = 'like',
        CONDITION_EQUAL = '=',
        CONDITION_IN = 'in',
        CONDITION_NOT_IN = 'not_in';

    const
        WHERE_CONDITIONS_AND = 'and',
        WHERE_CONDITIONS_OR = 'or';

    public function scopeSearch(Builder $query, $search, array $params = []);

}