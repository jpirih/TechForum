<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**  @test */
    public function it_tests_auth_user_can_create_threads()
    {
        $this->signIn();

        $thread = make('App\Thread');
        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);

    }

    /**  @test */
    public function it_tests_thread_requires_title()
    {
        $this->publishTread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /**  @test */
    public function it_tests_thread_requires_body()
    {
        $this->publishTread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /**  @test */
    public function it_tests_thread_requires_valid_channel()
    {
        factory('App\Channel', 2)->create();

        $this->publishTread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishTread(['channel_id' => 999999])
            ->assertSessionHasErrors('channel_id');
    }
    /**  @test */
    public function it_tests_guest_may_not_create_threads()
    {
        $this->withExceptionHandling();

        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads')
            ->assertRedirect('/login');

    }

    /**
     * Publish thread Helper function for tests
     * @param array $attributes
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function publishTread($attributes = [])
    {
        $this->withExceptionHandling()->signIn();
        $thread = make('App\Thread', $attributes);
        return $this->post('/threads', $thread->toArray());
    }
}
