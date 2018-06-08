<?php
/**
 * Created by PhpStorm.
 * User: janko
 * Date: 6. 06. 2018
 * Time: 16:09
 */

namespace App\Filters;


use Illuminate\Http\Request;

abstract class Filter
{
    /**
     * @var Request
     */
    protected $request;
    protected $builder;
    protected $filters = [];

    /**
     * ThreadFilters constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->filters as $filter) {
            if(method_exists($this, $filter) && $this->request->has($filter)) {
                $this->$filter($this->request->$filter);
            }
        }
        return $this->builder;

    }
}
