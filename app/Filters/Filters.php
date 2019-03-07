<?php
/**
 * Created by PhpStorm.
 * User: eg
 * Date: 07.03.2019
 * Time: 10:12
 */

namespace App\Filters;


use Illuminate\Http\Request;

abstract class Filters
{
    /**
     * @var Request
     */
    protected $request;
    protected $filters = [];
    protected $builder;

    /**
     * Filter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if ($this->hasFilter($filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    protected function getFilters()
    {
        $filters = array_intersect(array_keys($this->request->all()), $this->filters);
        return $this->request->only($filters);
    }

    protected function hasFilter($filter)
    {
        return method_exists($this, $filter);
    }
}
