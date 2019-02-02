<?php

namespace Tests\Feature;

use Illuminate\Auth\AuthenticationException;
use Tests\BaseTestCase;

class CreateThreadsTest extends BaseTestCase
{
    /** @test */
    public function a_guest_user_should_login_to_create_a_thread()
    {
        $this->expectException(AuthenticationException::class);

        $this->post(route('threads.store'));
    }

    /** @test */
    public function an_authenticated_user_can_create_a_thread()
    {
        // GIVEN we have an authenticated user
        // and a thread data
        $this->signIn();
        $thread = create(\App\Thread::class);

        // WHEN we send data to endpoint
        $this->post(route('threads.store'), $thread->toArray());

        // THEN we visit to thread view page
        $this->get($thread->path())
            // we should see thread body
            ->assertSeeText($thread->body);
    }
}
