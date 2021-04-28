<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    const RESPONSE_SUCCESS = 200;
    const RESPONSE_ERROR = 422;
}
