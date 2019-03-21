<?php
/**
 * Created by PhpStorm.
 * User: eg
 * Date: 07.03.2019
 * Time: 10:22
 */

namespace App\Filters;


use App\User;

class ThreadFilters extends Filters
{
    protected $filters = ['by', 'popular'];

    protected function by($value)
    {
        $filterUser = User::where('name', $value)->firstOrFail();
        return $this->builder->where('user_id', $filterUser->id);
    }

    protected function popular()
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count', 'desc');
    }
}
