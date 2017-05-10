<?php

namespace Mineur\TwitterStreamApiTest;

use PHPUnit\Framework\TestCase;


final class DumbTest extends TestCase
{
    /** @test */
    public function it_should_return_a_dummy_test()
    {
        $this->assertEquals(1, 1);
    }
}