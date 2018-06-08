<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;


    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function it_tests_that_reply_has_owner()
    {
       $reply = create('App\Reply');
       $this->assertInstanceOf('App\User', $reply->owner);
    }
}
