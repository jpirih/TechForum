<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function an_authenticated_user_my_pariticipate_in_forum_threads()
    {
        $this->be(create('App\User'));
        $thread = create('App\Thread');

        $reply = make('App\Reply');
        $this->post( $thread->path().'/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    public function unauth_user_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('threads/1/replies');

    }
}
