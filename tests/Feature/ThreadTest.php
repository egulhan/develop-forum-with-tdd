<?php

namespace Tests\Feature;

use App\Channel;
use App\Thread;
use App\User;
use Tests\BaseTestCase;

class ThreadTest extends BaseTestCase
{
    /** @test */
    public function a_thread_has_owner()
    {
        $thread = create(Thread::class);
        $this->assertInstanceOf(User::class, $thread->owner);
    }

    /** @test */
    public function a_thread_should_belong_to_a_channel()
    {
        // GIVEN a thread creation post data and an authenticated user
        $thread = make(Thread::class);

        $this->signIn();

        // WHEN create the thread
        $this->post(route('threads.store'), $thread->toArray());

        // THEN the thread should belong to a channel
        $this->assertEquals(1, Channel::count());
    }
}
