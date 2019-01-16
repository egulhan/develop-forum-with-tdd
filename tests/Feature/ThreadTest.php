<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    public function a_thread_has_owner()
    {
        $thread = factory(Thread::class)->create();
        $this->assertInstanceOf(User::class, $thread->owner);
    }
}
