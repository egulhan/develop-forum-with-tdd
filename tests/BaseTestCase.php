<?php
/**
 * Created by PhpStorm.
 * User: eg
 * Date: 22.01.2019
 * Time: 09:19
 */

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BaseTestCase extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;
}
