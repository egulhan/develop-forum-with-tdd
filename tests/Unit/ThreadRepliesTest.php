<?php

namespace Tests\Unit;

use App\Reply;
use Tests\BaseTestCase;

class ThreadRepliesTest extends BaseTestCase
{
    /** @test * */
    public function it_has_an_owner()
    {
        $reply = create(Reply::class);
        $this->assertInstanceOf(\App\User::class, $reply->owner);
    }
}
