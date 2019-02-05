<?php
/**
 * Created by PhpStorm.
 * User: eg
 * Date: 2/5/2019
 * Time: 4:27 AM
 */

namespace Tests\Unit;


use App\Channel;
use App\Thread;
use Tests\BaseTestCase;

class ChannelTest extends BaseTestCase
{
    /** @test */
    public function it_returns_all_threads_which_belong_to_it()
    {
        // GIVEN a channel and its threads
        $channel = create(Channel::class);
        $thread = create(Thread::class, ['channel_id' => $channel->id]);

        // WHEN call thread relationship
        // THEN it should has the thread
        $this->assertTrue($channel->threads->contains($thread));
    }
}
