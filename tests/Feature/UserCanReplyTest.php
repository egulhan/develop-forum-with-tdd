<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserCanReplyTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    public function an_authenticated_user_should_reply()
    {
        // GIVEN a thread
        $thread = factory(Thread::class)->create();
        $replier = factory(User::class)->create();
        $reply = factory(Reply::class)->make([
            'thread_id' => $thread->id,
        ]);

        // WHEN logged-in user try to reply
        $this->actingAs($replier)
            ->post(route('threads.reply', ['id' => $thread->id]), $reply->getAttributes())
            ->assertRedirect(route('threads.show', ['id' => $thread->id]));

        // THEN reply should be on the page
        $this->get(route('threads.show', ['id' => $thread->id]))
            ->assertSee($reply->body);
    }

    /** @test */
    public function a_guest_user_should_login_to_reply()
    {
        $this->expectException(AuthenticationException::class);

        // GIVEN a thread
        $thread = factory(Thread::class)->create();
        $replier = factory(User::class)->create();
        $reply = factory(Reply::class)->make([
            'thread_id' => $thread->id,
        ]);

        // WHEN user try to reply
        $this->post(route('threads.reply', ['id' => $thread->id]), $reply->getAttributes());

        // THEN it should throw authentication exception
    }
}
