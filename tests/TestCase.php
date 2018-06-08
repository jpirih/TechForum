<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /**
     * If user is not passed in the function
     * this function creates thest user and sign him in.
     * @param null $user
     * @return $this
     */
    protected function signIn($user = null)
    {
        $user = $user?: create('App\User');

        $this->actingAs($user);

        return $this;
    }
}
