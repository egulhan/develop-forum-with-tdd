<?php

namespace Tests\Unit;

use App\Reply;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ThreadRepliesTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test * */
    public function it_has_an_owner()
    {
        $reply = factory(Reply::class)->create();

        $this->assertInstanceOf(\App\User::class, $reply->owner);
    }
}
