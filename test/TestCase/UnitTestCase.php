<?php

namespace Mineur\TwitterStreamApiTest\TestCase;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

abstract class UnitTestCase extends TestCase
{
    protected function mock(string $class): MockInterface
    {
        return Mockery::mock($class);
    }
}