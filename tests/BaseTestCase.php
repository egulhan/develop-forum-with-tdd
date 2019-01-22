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

    protected function signIn($user = null)
    {
        $user = $user ?: create(\App\User::class);
        $this->actingAs($user);
        return $this;
    }
}
