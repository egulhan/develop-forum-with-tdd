<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Tests\BaseTestCase;

class ThreadTest extends BaseTestCase
{
    /** @test */
    public function a_thread_has_owner()
    {
        $thread = factory(Thread::class)->create();
        $this->assertInstanceOf(User::class, $thread->owner);
    }
}
