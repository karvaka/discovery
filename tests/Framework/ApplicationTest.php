<?php declare(strict_types=1);

namespace Tests\Framework;

use Tests\TestCase;

class ApplicationTest extends TestCase
{
    public function testRun(): void
    {
        $this->assertEquals('Hello world?', $this->app->run());
    }
}
