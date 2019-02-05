<?php
/**
 * Created by PhpStorm.
 * User: eg
 * Date: 22.01.2019
 * Time: 09:14
 */

/**
 * Factory make
 * @param $class
 * @param array $attributes
 * @param null $count
 * @return mixed
 */
function make($class, $attributes = [], $count = null)
{
    return factory($class, $count)->make($attributes);
}

/**
 * Factory create
 * @param $class
 * @param array $attributes
 * @param null $count
 * @return mixed
 */
function create($class, $attributes = [], $count = null)
{
    return factory($class, $count)->create($attributes);
}
