<?php

namespace Tests\Feature;

use App\Channel;
use App\Thread;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
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

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->expectException(ValidationException::class);

        $this->createThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->expectException(ValidationException::class);

        $this->createThread(['body' => null])
            ->assertSessionHasErrors('body');
    }


    /** @test */
    public function a_thread_requires_a_valid_channel()
    {
        $this->withExceptionHandling();

        $this->createThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        // create channels
        factory(Channel::class, 3)->create();

        $this->createThread(['channel_id' => 333])
            ->assertSessionHasErrors('channel_id');
    }

    protected function createThread($attributes = [])
    {
        $thread = make(Thread::class, $attributes);

        $this->signIn();

        return $this->post(route('threads.store'), $thread->toArray());
    }
}
