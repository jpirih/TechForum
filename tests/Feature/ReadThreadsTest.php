<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    protected function setUp()
    {
        parent::setUp();
        $this->thread = create('App\Thread');
    }

    /**
     * @test
     */
    function it_user_can_see_all_threads()
    {

        $response = $this->get('/threads');

        $response->assertSee($this->thread->title);
    }


    /**
     * @test
     */
    function it_user_can_see_thread_details()
    {
        $this->get( $this->thread->path())
            ->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    function it_user_can_read_replies_associated_with_thread()
    {
        $reply = create('App\Reply',['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /**  @test */
    public function it_tests_user_can_filter_threads_acording_to_cannel()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/'.$channel->slug)
        ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    /**  @test */
    public function it_tests_a_user_can_filter_threads_by_any_usernam()
    {
        $user = create('App\User', ['name' => 'Janko']);
        $this->signIn($user);
        $threadByJanko = create('App\Thread', ['user_id' => auth()->id()] );
        $threadNotByJanko = $this->thread;

        $this->get('/threads?by=Janko')
            ->assertSee($threadByJanko->title)
            ->assertDontSee($threadNotByJanko->title);


    }
}
