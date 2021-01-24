<?php declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        $this->setUpApplication();
    }

    public function tearDown(): void
    {
        parent::tearDown();

        $this->tearDownApplication();
    }
}
