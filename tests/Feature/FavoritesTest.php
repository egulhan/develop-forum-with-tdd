<?php

namespace Tests\Feature;

use App\Favorite;
use App\Reply;
use Illuminate\Database\QueryException;
use Tests\BaseTestCase;

class FavoritesTest extends BaseTestCase
{
    /** @test */
    public function guest_users_can_not_favorite_any_reply()
    {
        $this->withExceptionHandling();

        // GIVEN a guest user, a reply
        $reply = factory(Reply::class)->create();

        // WHEN the user try to favorite a reply
        $this->post(route('replies.favorite', ['id' => $reply->id]))
            // THEN it should redirect to login
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_favorite_a_reply()
    {
        // GIVEN a reply, an authenticated user
        $this->signIn();
        $reply = create(Reply::class);

        // WHEN the user try to favorite a reply

        $this->post(route('replies.favorite', ['id' => $reply->id]));

        // THEN it should be saved onto db
        $this->assertCount(1, Favorite::all()->toArray());
    }

    /** @test */
    public function an_authenticated_user_can_not_favorite_same_reply_twice()
    {
        // GIVEN a reply, an authenticated user
        $this->signIn();
        $reply = factory(Reply::class)->create();

        // WHEN the user try to favorite twice the same reply
        try {
            $this->post(route('replies.favorite', ['id' => $reply->id]));
            $this->post(route('replies.favorite', ['id' => $reply->id]));
        } catch (QueryException $e) {
            $this->fail('Unique constraint exception: a reply can not be favorited twice!');
        }

        // THEN it should not favorite it twice
        $this->assertCount(1, Favorite::all()->toArray());
    }
}
