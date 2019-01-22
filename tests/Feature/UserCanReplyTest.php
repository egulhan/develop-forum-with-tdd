<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Tests\BaseTestCase;

class UserCanReplyTest extends BaseTestCase
{
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
            ->post(route('replies.store', ['id' => $thread->id]), $reply->getAttributes())
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
        $this->post(route('replies.store', ['id' => $thread->id]), $reply->getAttributes());

        // THEN it should throw authentication exception
    }

    /** @test */
    public function a_reply_requires_comment()
    {
        // GIVEN a thread and auth. user
        $thread = factory(Thread::class)->create();
        $user = factory(User::class)->create();
        $reply = factory(Reply::class)->make([
            'body' => '',
        ]);

        // WHEN reply to the thread
        $response = $this->actingAs($user)
            ->post(route('replies.store', ['id' => $thread->id]), $reply->getAttributes());

        // THEN if comment is empty, returns an error
        $response->assertSessionHasErrors(['body']);
    }

    /** @test */
    public function a_reply_comment_must_contain_at_least_5_characters()
    {
        // GIVEN a thread and auth. user
        $thread = factory(Thread::class)->create();
        $user = factory(User::class)->create();
        $reply = factory(Reply::class)->make(['body' => 1]);

        // WHEN reply to the thread
        $response = $this->actingAs($user)
            ->post(route('replies.store', ['id' => $thread->id]), $reply->getAttributes());

        // THEN get an error for comment field
        $response->assertSessionHasErrors(['body']);
    }
}
