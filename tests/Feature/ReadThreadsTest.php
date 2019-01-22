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

        $this->get(route('threads.show', ['id' => $thread->id]))
            ->assertSeeText($thread->title);
    }

    /** @test */
    public function threads_replies_can_be_viewed_on_page()
    {
        $thread = create(Thread::class);
        $reply = create(Reply::class, ['thread_id' => $thread->id]);

        $this->get(route('threads.show', ['id' => $thread->id]))
            ->assertSeeText($reply->body);
    }
}
