<?php
/**
 * Created by PhpStorm.
 * User: eg
 * Date: 07.03.2019
 * Time: 11:26
 */

namespace App\Traits;

use App\Filters\Filters;

trait Filterable
{
    /**
     * Scope to filter Eloquent Models
     * @param $query
     * @param Filters $filters
     * @return mixed
     */
    public function scopeFilter($query, Filters $filters)
    {
        return $filters->apply($query);
    }
}
