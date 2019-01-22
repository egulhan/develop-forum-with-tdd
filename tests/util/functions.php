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
 * @return mixed
 */
function make($class, $attributes = [])
{
    return factory($class)->make($attributes);
}

/**
 * Factory create
 * @param $class
 * @param array $attributes
 * @return mixed
 */
function create($class, $attributes = [])
{
    return factory($class)->create($attributes);
}
