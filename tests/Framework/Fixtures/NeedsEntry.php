<?php declare(strict_types=1);

namespace Tests\Framework\Fixtures;

class NeedsEntry
{
    public function __construct(
        private Entry $entry
    )
    {

    }
}
