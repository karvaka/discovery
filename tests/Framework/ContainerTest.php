<?php declare(strict_types=1);

namespace Tests\Framework;

use App\Framework\Container;
use Tests\Framework\Fixtures\Entry;
use Tests\Framework\Fixtures\NeedsEntry;
use Tests\TestCase;

class ContainerTest extends TestCase
{
    public function testAddsSingleton(): void
    {
        $container = new Container();

        $this->assertNull($container->get(Entry::class));

        $container->addSingleton(Entry::class, $entry = new Entry());

        $this->assertTrue($entry === $container->get(Entry::class));
    }

//    public function testConstructs(): void
//    {
//        $container = new Container();
//
//        $this->assertInstanceOf(NeedsEntry::class, $container->construct(NeedsEntry::class));
//    }

//    public function testCalls()
//    {
//
//    }
}
