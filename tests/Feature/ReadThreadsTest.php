<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Tests\BaseTestCase;

class ReadThreadsTest extends BaseTestCase
{
    /** @test * */
    public function it_can_list_all_threads()
    {
        $thread = create(Thread::class);

        $response = $this->get(route('threads.index'));

        $response->assertStatus(200);

        $response->assertSeeText($thread->title);
    }

    /** @test * */
    public function it_can_view_a_single_thread()
    {
        $thread = create(Thread::class);

        $this->get($thread->path())
            ->assertSeeText($thread->title);
    }

    /** @test */
    public function threads_replies_can_be_viewed_on_page()
    {
        $thread = create(Thread::class);
        $reply = create(Reply::class, ['thread_id' => $thread->id]);

        $this->get($thread->path())
            ->assertSeeText($reply->body);
    }

    /** @test */
    public function threads_can_be_filtered_by_username()
    {
        $this->signIn();

        // GIVEN a thread created by the user and a thread not created by him
        $threadByUser = factory(Thread::class)->create([
            'user_id' => auth()->id()
        ]);
        $threadNotByUser = factory(Thread::class)->create();

        // WHEN filter by his username
        // THEN
        $url = route('threads.index') . '?by=' . auth()->user()->name;
        $this->get($url)
            // filtered threads should belong to him
            ->assertSeeText($threadByUser->title)
            ->assertDontSeeText($threadNotByUser->title);
    }

    /** @test */
    public function threads_can_be_filtered_by_popularity()
    {
        // GIVEN create threads with 1 reply, 3 replies, 2 replies
        $threadWithOneReply = create(Thread::class);
        create(Reply::class, ['thread_id' => $threadWithOneReply->id]);

        $threadWithThreeReplies = create(Thread::class);
        create(Reply::class, ['thread_id' => $threadWithThreeReplies->id], 3);

        $threadWithTwoReplies = create(Thread::class);
        create(Reply::class, ['thread_id' => $threadWithTwoReplies->id], 2);

        // WHEN user filter threads by popularity
        $response = $this->getJson(route('threads.index') . '?popular=1')->json();

        // THEN they should be returned from most replies to least
        $this->assertEquals([3, 2, 1], array_column($response, 'replies_count'));
    }
}
