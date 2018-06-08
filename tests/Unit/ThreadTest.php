<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    protected function setUp()
    {
        parent::setUp();
        $this->thread = create('App\Thread');

    }

    /** @test */
    public function it_testst_thread_belongs_to_cnannel()
    {
        $this->assertInstanceOf('App\Channel', $this->thread->channel);
    }

    /** @test */
    public function it_tests_thread_has_string_path()
    {
        $this->assertEquals('/threads/'. $this->thread->channel->slug. '/'. $this->thread->id, $this->thread->path());
    }

    /** @test */
    public function it_tests_thread_has_replies()
    {

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */
    public function it_tests_thread_has_owner()
    {
        $this->assertInstanceOf('App\User', $this->thread->owner);
    }


    /** @test  */
    public function it_tests_that_reply_can_be_added_to_thread()
    {
        // given ve have a thread
        $this->thread->addReply([
            'body' => 'Foo Bar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }
}
