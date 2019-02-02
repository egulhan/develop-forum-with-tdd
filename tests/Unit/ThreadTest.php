<?php

namespace Tests\Unit;

use App\Thread;
use Tests\BaseTestCase;

class ThreadTest extends BaseTestCase
{
    /** @test */
    public function thread_path_should_be_valid()
    {
        // GIVEN a created thread
        $thread = factory(Thread::class)->create();

        // WHEN called path method of the thread
        $actualPath = $thread->path();
        $expectedPath = '/threads/' . $thread->channel->slug . '/' . $thread->id;

        // THEN it should be correct
        $this->assertEquals($expectedPath, $actualPath);
    }
}
