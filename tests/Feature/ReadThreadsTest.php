<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /** @test * */
    public function it_can_list_all_threads()
    {
        $thread = factory(Thread::class)->create();

        $response = $this->get(route('threads.index'));

        $response->assertStatus(200);

        $response->assertSeeText($thread->title);
    }

    /** @test * */
    public function it_can_view_a_single_thread()
    {
        $thread = factory(Thread::class)->create();

        $this->get(route('threads.show', ['id' => $thread->id]))
            ->assertSeeText($thread->title);
    }

    /** @test */
    public function threads_replies_can_be_viewed_on_page()
    {
        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->create(['thread_id' => $thread->id]);

        $this->get(route('threads.show', ['id' => $thread->id]))
            ->assertSeeText($reply->body);
    }
}
