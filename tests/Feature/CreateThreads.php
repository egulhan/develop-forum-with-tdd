<?php

namespace Tests\Feature;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Validation\UnauthorizedException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreads extends TestCase
{
    use DatabaseMigrations;

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
        $user = factory(\App\User::class)->create();
        $thread = factory(\App\Thread::class)->create();

        $this->actingAs($user);

        // WHEN we send data to endpoint
        $this->post(route('threads.store'), $thread->toArray());

        // THEN we visit to thread view page
        $this->get(route('threads.show', ['id' => $thread->id]))
            // we should see thread body
            ->assertSeeText($thread->body);
    }
}
