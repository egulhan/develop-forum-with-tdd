<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test * */
    public function it_can_list_all_threads()
    {
        $thread = factory(Thread::class)->create();

        $this->get(route('threads.index'))
            ->assertStatus(200)
            ->assertSeeText($thread->title);
    }

    /** @test * */
    public function it_can_view_a_single_thread()
    {
        $thread = factory(Thread::class)->create();

        $this->get(route('threads.show', ['id' => $thread->id]))
            ->assertSeeText($thread->title);
    }

    /** @test * */
    public function it_can_view_a_thread_with_its_replies()
    {
        $thread = factory(Thread::class)->create();
        $replies = factory(Reply::class, 5)->create(['thread_id' => $thread->id]);

        $this->get(route('threads.show', ['id' => $thread->id]))
            ->assertSeeText($replies[0]->body);
    }
}
